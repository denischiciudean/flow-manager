<?php


namespace App\StateTrack;


trait StepStateTrait
{
    public function track_reassign($new_user)
    {
        $this->stateChanges()->create([
            'user_id' => \Auth::user()->id ?? null,
            'type' => StepStateTrack::STEP_ASSIGNED,
            'note' => 'Reatribuit',
            'data' => [
                'old' => ['user_id' => $this->assigned_to],
                'new' => ['user_id' => $new_user]
            ]
        ]);
    }

    public function track_created()
    {
        $this->stateChanges()->create([
            'user_id' => \Auth::user()->id ?? null,
            'type' => StepStateTrack::STEP_CREATED,
            'note' => 'Creat | ' . $this->step ? $this->step->name : '',
            'data' => [
                'user_id' => $this->task->created_by,
                'task_id' => $this->task->id
            ]
        ]);
    }


    public function track_step_completed()
    {
        $this->stateChanges()->create([
            'user_id' => \Auth::user()->id ?? null,
            'type' => StepStateTrack::STEP_COMPLETED,
            'note' => 'Completat',
            'data' => [
                'completed_at' => now()
            ]
        ]);
    }
}
