<?php


namespace App\StateTrack;


trait TaskStateTrait
{
    public function track_task_created()
    {
        $this->stateChanges()->create([
            'user_id' => $this->created_by,
            'type' => TaskStateTrack::TASK_CREATE,
            'note' => 'Creare',
            'data' => [
                'user_id' => $this->created_by,
                'task_id' => $this->id
            ]
        ]);
    }

    public function track_task_updated($new_user)
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => StepStateTrack::STEP_ASSIGNED,
            'note' => 'Reatribuit ',
            'data' => [
                'old' => ['user_id' => $this->assigned_to],
                'new' => ['user_id' => $new_user]
            ]
        ]);
    }

    public function track_task_status($new_status)
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => TaskStateTrack::TASK_STATUS_UPDATE,
            'note' => $new_status,
            'data' => [
                'old' => ['status' => $this->status],
                'new' => ['status' => $new_status]
            ]
        ]);
    }

    /**
     * @param $split_task_id
     * @param string $type - this wether is the og event or from the split
     */
    public function track_task_split($split_task_id, string $type = TaskStateTrack::TASK_SPLIT_TYPE_OG)
    {
        $this->stateChanges()->create([
            'user_id' => \Auth::user()->id ?? null,
            'type' => TaskStateTrack::TASK_SPLIT,
            'note' => $type = TaskStateTrack::TASK_SPLIT_TYPE_OG ? "Alta nota adiacenta creata" : 'Create de alta nota',
            'data' => [
                'origin' => $this->id,
                'created' => $split_task_id,
                'type' => $type
            ]
        ]);
    }


}
