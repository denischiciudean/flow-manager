<?php


namespace App\StateTrack;


trait StepStateTrait
{
    public function track_reassign($new_user)
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => StepStateTrack::STEP_ASSIGNED,
            'note' => 'Step Reassigned',
            'data' => [
                'old' => ['user_id' => $this->assigned_to],
                'new' => ['user_id' => $new_user]
            ]
        ]);
    }

    public function track_created()
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => StepStateTrack::STEP_CREATED,
            'note' => 'Step Created | ' . $this->step ? $this->step->name : '',
            'data' => [
                'user_id' => $this->task->created_by,
                'task_id' => $this->task->id
            ]
        ]);
    }


    public function track_step_completed()
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => StepStateTrack::STEP_COMPLETED,
            'note' => 'Step Completed',
            'data' => [
                'completed_at' => now()
            ]
        ]);
    }
}
