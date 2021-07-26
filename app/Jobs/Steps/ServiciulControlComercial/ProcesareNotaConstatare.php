<?php

namespace App\Jobs\Steps\ServiciulControlComercial;

use App\Models\Permission;
use App\Models\Task;
use App\Models\TaskSplit;
use App\Models\TaskStep;
use App\Models\User;
use App\Models\Workflow;
use App\Permissions\TaskPermissions;
use App\StateTrack\TaskStateTrack;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ProcesareNotaConstatare implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $slug = 'job-procesare-nota-de-constatare';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public $task_step)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //IF MARKED NEW WORKFLOW FORK IT AND CREATE A NEW WORKFLOW
        $has_proces_verbal = (bool)$this->task_step->data['emis_proces_verbal'];

        $task_data = $this->task_step->data;

        $title = $task_data['constatare_seria'] . '-' . $task_data['constatare_nr'];

        /**
         * update task series
         */
        $this->task_step->task->series = (string)Str::of($title)->replace('/', '#');
        $this->task_step->task->save();
        /**
         * end update task series
         */

        $this->task_step->task->update([
            'title' => $title,
            'description' => "Agent Constatator : {$task_data['agent_constatator_1']} <br> Agent Economix : {$task_data['agent_economic_nume']}",
            'slug' => (string)Str::of($title)->slug()
        ]);

        try {
            /**
             * Gather Data
             */
            $task = $this->task_step->task;
            $workflow_steps = $task->workflow->steps;
            $current_step = $workflow_steps->filter(fn($it) => $it->slug == $this->slug)->first();
            $next_step = $workflow_steps->filter(fn($it) => $it->pivot->rank == ($current_step->pivot->rank + 1))->first();
            if ($has_proces_verbal) {
                $this->createProcesVerbal();
            }

            $this->task_step->is_done = true;
            $this->task_step->is_current = false;
            /**
             * Update old step
             */
            $this->task_step->save();
            $this->task_step->track_step_completed();

            // mark prev & current as done and you're done
            $new_step = TaskStep::create([
                'task_id' => $task->id,
                'step_id' => $next_step->id,
                'assigned_to' => null,
                'is_done' => false,
                'is_current' => true,
                'data' => null
            ]);

            $task->track_task_status("Nota Constatare Procesata");
            $task->update(['status' => 'nota_constatare_procesata']);

            /**
             * New Step Created
             */
            $new_step->track_created();
            if ($next_step->type == 'job') {
                //Nu-i cazul aici momentan | In caz ca urmatoarea componenta e job, run it also
//                dispatch(new $next_step->step->component());
            }
            // Next step is a job, we should start it here

            /**
             * Old Step Track Completed
             */
        } catch (\Exception $e) {
            dd($e);
        }
    }


    private function createProcesVerbal()
    {

        $proces_verbal_workflow = Workflow::where('slug', 'proces-verbal-serviciul-control-comercial')->first();
        $task = $this->task_step->task;

        /**
         *
         */
        $proces_verbal_task = Task::create([
            'department_id' => $task->department_id,
            'workflow_id' => $proces_verbal_workflow->id,
            'created_by' => $task->created_by,
            'title' => 'PV - ' . $task->slug,
            'description' => ' ',
            'slug' => \Str::of('PV - ' . $task->slug)->slug(),
            'status' => 'created',
            'expires_at' => now()->addDays($proces_verbal_workflow->expiration_in)
        ]);

        $proces_verbal_task->track_task_created();
        $proces_verbal_task->track_task_status('Created');

        $first_step = $proces_verbal_workflow->steps()->wherePivot('rank', 1)->first();

        $p_task_step = TaskStep::create([
            'task_id' => $proces_verbal_task->id,
            'step_id' => $first_step->id,
            'assigned_to' => null,
            'is_done' => false,
            'is_current' => true,
            'completed_at' => null,
            'data' => null
        ]);

        $p_task_step->track_created();

        /**
         * Track 2 events, one for x other for y
         */
        $this->task_step->task->track_task_split($proces_verbal_task->id);
        $proces_verbal_task->track_task_split($this->task_step->task->id, TaskStateTrack::TASK_SPLIT_TYPE_SPLIT);

        TaskSplit::create([
            'og_task_id' => $task->id,
            'og_step_id' => $this->task_step->id,
            'dest_task_id' => $proces_verbal_task->id
        ]);

        /**
         * Create Permission and add to boss and down
         */

        /**
         * CREATE A PERMISSION FOR THIS TASK, SO WE CAN LET OTHER USERS SEE IT AND ACCESS IT
         */
        Permission::updateOrCreate(
            [
                'name' => TaskPermissions::VIEW($task->slug)
            ],
            [
                'guard_name' => 'web',
                'display_name' => TaskPermissions::DISPLAY_VIEW($task->title)
            ]
        );
        $user = User::find($this->task_step->task->created_by);
        /**
         * GIVE THIS USER THE PERMISSION TO ACCESS AND SEE IT
         */
        $user->givePermissionTo(TaskPermissions::VIEW($task->slug));

    }
}

