<?php

namespace App\Jobs\Steps\ServiciulControlComercial;

use App\Models\TaskStep;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ProcesareProcesVerbalForm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $slug = 'job-procesare-proces-verbal-form';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public TaskStep $step)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $existing_articles = collect($this->step->step->validation['data']['articole'])->map(fn($it) => (string)\Str::of($it)->replace(' ', '')->lower());
        $amenzi = $this->step->data['amenzi'];

        $articole_to_add = [];

        foreach ($amenzi as $amenda) {
            $prevederi = Str::of($amenda['prevederi_incalcate'])->lower()->replace(' ', '');
            $sanctionare = Str::of($amenda['sanctionare_conform'])->lower()->replace(' ', '');

            if (!$existing_articles->contains($prevederi)) {
                $articole_to_add[] = $amenda['prevederi_incalcate'];
            }
            if (!$existing_articles->contains($sanctionare)) {
                $articole_to_add[] = $amenda['sanctionare_conform'];
            }
        }
        if (count($articole_to_add)) {
            $validation = $this->step->step->validation;
            $validation['data']['articole'] = [...$validation['data']['articole'], ...$articole_to_add];
            $this->step->step->validation = $validation;
            $this->step->step->save();
        }

        // We processed the new stuff, now advance to the next GUI step

        $this->step->is_done = true;
        $this->step->is_current = false;
        /**
         * Update old step
         */
        $this->step->save();
        $this->step->track_step_completed();
        $task = $this->step->task;
        $workflow_steps = $task->workflow->steps;
        $current_step = $workflow_steps->filter(fn($it) => $it->slug == $this->slug)->first();
        $next_step = $workflow_steps->filter(fn($it) => $it->pivot->rank == ($current_step->pivot->rank + 1))->first();
        // mark prev & current as done and you're done
        $new_step = TaskStep::create([
            'task_id' => $this->step->task->id,
            'step_id' => $next_step->id,
            'assigned_to' => null,
            'is_done' => false,
            'is_current' => true,
            'data' => null
        ]);

        $task->track_task_status("Proces Verbal Procesat");
        $task->update(['status' => 'proces_verbal_procesat']);

        /**
         * New Step Created
         */
        $new_step->track_created();

    }
}
