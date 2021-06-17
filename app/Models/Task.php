<?php

namespace App\Models;

use App\Components\TimeHelpers;
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

    public function mapForDashboard()
    {
        $it = $this;
//        $a = $this->slug ?: dd($this->slug ?? 'asd');
        return [
            'id' => $this->id,
            'title' => $it->title,
            'description' => $it->description,
            'department_path' => $it->department->ancestorsAndSelf()->get()->sortBy('id')->map(fn($dep) => $dep->name)->toArray(), #here we will make the path generation
            'created' => TimeHelpers::convertTimestampToDayHoursLeft($it->created_at, 'Acum {days} zile, {hours} ore ({date})'),
            'assigned_to' => $it->currentStep && $it->currentStep->assignedTo ? 'Atribuit lui ' . $it->currentStep->assignedTo->name . ' acum ' . TimeHelpers::convertTimestampToDayHoursLeft($it->currentStep->updated_at, '{days} zile, {hours} ore') : 'Neatribuit',
            'expires_at' => TimeHelpers::timeLeft($it->expires_at->timestamp)[1],
            'href' => route('task.view', ['task_id' => $this->id, 'task_slug' => $this->slug ?? 'task'])
        ];
    }

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
