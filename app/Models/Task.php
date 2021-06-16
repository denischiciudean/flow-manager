<?php

namespace App\Models;

use App\StateTrack\TaskStateTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, TaskStateTrait;

    protected $guarded = [];

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    public function steps()
    {
        return $this->hasMany(TaskStep::class, 'task_id');
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class, 'workflow_id');
    }

    public function currentStep()
    {
        return $this->hasOne(TaskStep::class, 'task_id')->where('is_current', true);
    }

    public function parent_split()
    {
        return $this->belongsToMany(self::class, 'task_splits', 'dest_task_id', 'og_task_id')->withPivot(['og_step_id']);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function stateChanges()
    {
        return $this->morphToMany(StateTrack::class, 'state_trackable');
    }

}
