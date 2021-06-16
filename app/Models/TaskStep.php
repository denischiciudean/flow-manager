<?php

namespace App\Models;

use App\StateTrack\StepStateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStep extends Model
{
    use HasFactory, StepStateTrait;

    protected $guarded = [];

    protected $table = 'task_steps';

    protected $casts = [
        'data' => 'json'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function step()
    {
        return $this->belongsTo(Step::class, 'step_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function stateChanges()
    {
        return $this->morphToMany(StateTrack::class, 'state_trackable');
    }
}
