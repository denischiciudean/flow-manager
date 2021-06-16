<?php

namespace App\Models;

use App\Permissions\WorkflowPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();
        //Create permissions for this workflow
        self::created(function ($model) {
            $model->slug = \Str::of($model->name . '-' . $model->department->name)->slug;
            // View Nova Permission
            Permission::updateOrCreate(
                [
                    'slug' => WorkflowPermissions::CREATE($model->department->slug, $model->slug),
                ],
                [
                    'name' => WorkflowPermissions::DISPLAY_CREATE($model->department->name, $model->name),
                    'guard_name' => 'web'
                ]
            );
        });
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function steps()
    {
        return $this->belongsToMany(Step::class, 'workflow_steps', 'workflow_id', 'step_id')
            ->withPivot(['resolution_department_id', 'blocking', 'rank']);
    }
}

