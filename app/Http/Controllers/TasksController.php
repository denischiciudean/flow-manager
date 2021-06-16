<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Task;
use App\Models\TaskStep;
use App\Models\Workflow;
use App\Permissions\DepartmentsPermissions;
use App\Permissions\WorkflowPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TasksController extends Controller
{

    public function advanceStep(Request $request)
    {
        [
            'step_id' => $step_id,
            'data' => $data
        ] = $request->all();


        /**
         * Validate the data
         */

        //Send back if error

        /**
         * Data is validated
         */

        $step = TaskStep::find($step_id);
        if (!$step) {
            return redirect()->back()->with(['message' => 'An error occurred!']);
        }
        $task = $step->task;

        $current_workflow_step = $step->step;

        $all_workflow_steps = $step->task->workflow->steps->sortBy('pivot.rank');

        $max_rank = $all_workflow_steps->max('pivot.rank');

        $current_rank = $all_workflow_steps
            ->filter(fn($it) => $it->id == $current_workflow_step->id)
            ->first()
            ->pivot->rank;

        $files = $request->allFiles();

        /**
         * IF THERE WERE
         * PROCESS THEM, SAVE THEM ON DISK AND RETURN THE PATH FOR THE FILE
         */
        if (count($files)) {
            $files = $this->processFiles($task, $files);
            foreach ($files as $index => $value) {
                $data[$index] = $value;
            }
        }
        $step->data = $data;
        $step->is_current = false;
        $step->is_done = true;
        $step->completed_at = now();
        $step->track_step_completed();
        $step->save();
        /*
         * Check if this is the last step or not
         */
        if ($max_rank == $current_rank) {
            /**
             * Complete the step, add data close
             */
            $task->completed_at = now();
            $task->status = 'done';
            $task->track_task_status('done');
            $task->save();

            return redirect()->route('task.view', ['task_id' => $task->id, 'task_slug' => $task->slug]);
        } else {
            /**
             * Get Next Step & prepare
             */
            $next_step = $all_workflow_steps->where('pivot.rank', $current_rank + 1)->first();
            switch ($next_step->type) {
                case 'job':
                    dispatch(new $next_step->component($step));
                    break;

                case 'gui':
                    $new_step = TaskStep::create([
                        'task_id' => $task->id,
                        'step_id' => $next_step->id,
                        'assigned_to' => null,
                        'is_done' => false,
                        'is_current' => true,
                        'data' => null
                    ]);
                    $new_step->track_created();
                    break;
            }

            return redirect()->route('task.view', [
                'task_id' => $task->id,
                'task_slug' => $task->slug
            ]);
        }
    }

    public function viewFile(Request $request, TaskStep $step, $data_key, $file)
    {
        $roles = $step->task->department->getAncestorsAndSelfRoles();
        if (!$request->user()->hasAnyRole($roles)) {
            return "Unauthorized";
        }
        if (!isset($step->data[$data_key])) {
            return "Unknown File";
        }

        $file = collect($step->data[$data_key])->filter(function ($it) use ($file) {
            return Str::of($it)->contains($file);
        })->first();

        if (!$file) {
            return "Unknown File";
        }
        return response()->download(storage_path('app/' . $file));
    }

    public function reassign(Request $request)
    {

        $new_user = $request->get('user');
        $step = TaskStep::find($request->get('step'));

        //here some checks
        $step->track_reassign($new_user);
        $step->assigned_to = $new_user;
        $step->save();
        return redirect()->route('dashboard');
    }

    public function view(Request $request, $task)
    {
        $task = Task::where('id', $task)->with('steps')->first();
        $flow = $task->workflow()->with('steps')->first();

        $task_changes = $task->stateChanges()->get();

        $history = $task->steps()->with('stateChanges')->get()->pluck('stateChanges')->flatten()->merge($task_changes)->sortBy('id')->values()->toArray();

        $task_department = $task->department;
        $parent_task_split = $task->parent_split->first();
        $done_steps = $task->steps->where('is_done', true)->map(function ($it) use ($flow) {
            $step = $flow->steps->where('id', $it->step_id)->first();
            $it->name = $step->name;
            $it->rank = $step->pivot->rank;
            $it->component = \Str::of($step->component)->explode('/')->last();
            return $it;
        })->sortBy('rank')->values();

        if ($parent_task_split) {
            $og_step = TaskStep::find($parent_task_split->pivot->og_step_id);

            $flow_steps = $og_step->task->workflow->steps;

            $previous_steps = $flow_steps->where('pivot.rank', '<=', $flow_steps->filter(fn($it) => $it->id == $og_step->step_id)->first()->pivot->rank);

            $steps = $og_step
                ->task
                ->steps
                ->where('is_done', true)
                ->whereIn('step_id', $previous_steps->pluck('id')->toArray())
                ->map(function ($it) use ($previous_steps) {
                    $step = $previous_steps->where('id', $it->step_id)->first();
                    $it->name = $step->name;
                    $it->component = \Str::of($step->component)->explode('/')->last();
                    return $it;
                });

            $done_steps = [...$steps, ...$done_steps];
        }
        $current_step = $task->currentStep()->with('assignedTo')->first();
        $allowed_to_reassign = false;
        $reassign_users = [];
        if (!$task->completed_at && $current_step) {
            $current_step->component = \Str::of($current_step->step->component)->explode("/")->last();

            $user = \Auth::user();

            $departments_ancestors_and_self = $task_department->ancestorsAndSelf()->get();

            $department_sef_roles = $departments_ancestors_and_self->pluck('slug')->map(fn($it) => 'sef-' . $it)->toArray();
            if (
                $user->hasAnyRole($department_sef_roles) ||
                $task->currentStep()->first()->assigned_to == $user->id
            ) {
                $allowed_to_reassign = true;
                $users = $departments_ancestors_and_self->pluck('users');
                $bosses = $users->flatten()->filter->hasAnyRole($department_sef_roles);
                $employees = $task_department->users->filter->hasRole('angajat-' . $task_department->slug);

                //Take reassignable users
                $reassign_users = [...$bosses, ...$employees];
            }
        }
        return Inertia::render('Tasks/ViewTask', [
            'task' => $task,
            'workflow' => $flow,
            'done_steps' => $done_steps,
            'current_step' => $current_step,
            'allowed_to_reassign' => $allowed_to_reassign,
            'reassign_users' => $reassign_users,
            'history' => $history
        ]);
    }

    public function selectDepartment(Request $request)
    {
        $user = $request->user();

        $department = $user->primary_department->first();

        if (!$department->has_children && $user->hasAnyRole('sef-' . $department->slug)) {
            return redirect()->route('task.create.select_workflow', ['department_id' => $department->id, 'department_slug' => $department->slug]);
        }

        $children = $department->descendants()->whereHas('workflows')->get()->filter(fn($it) => $user->can(DepartmentsPermissions::VIEW($it->slug)));

        return Inertia::render('Tasks/Create/SelectDepartment', [
            'departments' => $children,
            'step' => 1
        ]);
    }

    public function selectWorkflow(Request $request, $department)
    {
        $user = $request->user();
        $department = Department::where('id', $department)->with('workflows')->first();
        $workflows = $department->workflows->filter(fn($it) => $user->can(WorkflowPermissions::CREATE($it->slug)));
        return Inertia::render('Tasks/Create/SelectWorkflow', ['step' => 2, 'workflows' => $workflows, 'selected_department' => $department]);
    }

    /**
     * CREATE FORM
     *
     * @param Request $request
     * @param $workflow
     * @return \Inertia\Response
     */
    public function create(Request $request, $workflow)
    {
        $user = $request->user();

        $workflow = Workflow::where('id', $workflow)->with('steps')->first();

        if (!$user->can(WorkflowPermissions::CREATE($workflow->slug))) {
            abort(403);
        }

        $first_step = $workflow->steps->where('pivot.rank', 1)->first();

        return Inertia::render('Tasks/Create/FillTaskFirstStep', [
            'step' => $first_step,
            'workflow_id' => $workflow->id,
            'workflow_slug' => $workflow->slug,
            'selected_department' => $workflow->department
        ]);
    }

    private function processFiles($task, $files)
    {
        $total = 1;
        $results = [];
        foreach ($files as $key => $_files) {
            $results[$key] = [];
            foreach ($_files as $index => $file) {
                $ext = explode('.', $file->getClientOriginalName());
                $ext = $ext[count($ext) - 1];
                $path = $file->storeAs('uploads' . '/' . $key, 'anexa-' . $total . '-' . $task->id . '.' . $ext);
                $results[$key][$index] = $path;
                $total++;
            }
        }
        return $results;
    }

    public function createTask(Request $request, $workflow)
    {
        $user = \Auth::user();
        /**+*
         * GET THE WORKFLOW
         */
        $workflow = Workflow::find($workflow);
        /**
         * GET THE FIRST STEP ASSOCIATED WITH THIS WORKFLOW
         * AS HERE IT WILL START
         *
         * BELOW LINE CAN BE MADE IN 1 QUERY not 2
         */
        $step = $workflow->steps()->wherePivot('rank', 1)->first();
        $next_step = $workflow->steps()->wherePivot('rank', 2)->first();
        /**
         * GET ALL THE DATA FROM THE FORMv
         */
        $data = $request->all();

        /**
         * VALIDATE ALL THIS DATA
         */

//        $validation_rules = $step->validation['form'];
//        $validation = Validator::make($data, $validation_rules);
//        $validation->validate();

        /**
         * GET THIS TASKS TITLE AND DESCRIPTION AND CREATE THE SLUGS
         */

        /**
         * CREATE THE TASK AND MAIN IDENTIFIER WILL BE SLUG
         * FOR FUTURE PERMISSIONS AND OTHER STUFF
         */
        $task = Task::create(
            [
                'department_id' => $workflow->department_id,
                'workflow_id' => $workflow->id,
                'created_by' => \Auth::user()->id,
                'expires_at' => now()->addHours($workflow->expiration_in),
            ]
        );

        $task->track_task_created();

        /**
         * GET ALL THE FILES IF THERE WERE ANY FROM THE FORM
         */
        $files = $request->allFiles();

        /**
         * IF THERE WERE
         * PROCESS THEM, SAVE THEM ON DISK AND RETURN THE PATH FOR THE FILE
         */
        if (count($files)) {
            $files = $this->processFiles($task, $files);
            foreach ($files as $index => $value) {
                $data[$index] = $value;
            }
        }

        /**
         * TODO : PERMISSION RELATED STUFF WHICH IS NO LONGER RELEVANT
         */

//        /**
//         * CREATE A PERMISSION FOR THIS TASK, SO WE CAN LET OTHER USERS SEE IT AND ACCESS IT
//         */
//        Permission::updateOrCreate(
//            [
//                'name' => TaskPermissions::VIEW($slug)
//            ],
//            [
//                'guard_name' => 'web',
//                'display_name' => TaskPermissions::DISPLAY_VIEW($title)
//            ]
//        );
        /**
         * GIVE THIS USER THE PERMISSION TO ACCESS AND SEE IT
         */
//        $user = \Auth::user();
//        $user->givePermissionTo(TaskPermissions::VIEW($slug));

        /**
         * GET THE CURRENT DEPARTMENT AND ADD TO THE ROLES LIST TO WHICH WE ALSO HAVE TO ADD THIS PERMISSION
         */
//        $department = $workflow->department;
//        $roles = [
//            'sef-' . $department->slug,
//            'angajat-' . $department->slug,
//        ];

//        /**
//         * ALSO ALL THE ANCESTORS OF THI DEPARTMENT SHOULD HAVE ACCESS (ONLY BOSS NOT EMPLOYESS)
//         */
//        foreach ($department->ancestors()->get() as $department) {
//            $roles[] = 'sef-' . $department->slug;
//        }
//
//        /**
//         * GET ALL THE ROLES THAT FIT THE ABOVE DESCRIPTION AND GIVE THESE PERMISSIONS
//         */
//
//        $roles = Role::whereIn('name', $roles)->get();
//        $roles->map(fn($it) => $it->givePermissionTo(TaskPermissions::VIEW($task->slug)));

        $task_step = TaskStep::updateOrCreate(
            [
                'task_id' => $task->id,
                'step_id' => $step->id
            ],
            [
                'assigned_to' => $user->id,
                'is_done' => true,
                'is_current' => false,
                'completed_at' => now(),
                'data' => $data,
            ]
        );

        $task_step->track_created();

        if ($next_step->type == 'job') {
            //DISPATCH THE NEXT STEP AUTOMATICALLY
            dispatch(new $next_step->component($task_step));
        }

        $task = $task->fresh();

        return redirect()->route('task.view', ['task_id' => $task->id, 'task_slug' => $task->slug]);
    }

}
