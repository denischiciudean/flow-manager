<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Department extends Model
{
    use HasFactory, HasRecursiveRelationships;

    protected $guarded = [];

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class, 'department_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_departments', 'department_id', 'user_id');
    }

//    public function sub(): HasMany
//    {
//        return $this->hasMany(self::class, 'parent_id');
//    }
//
//    public function parent(): BelongsTo
//    {
//        return $this->belongsTo(self::class, 'parent_id');
//    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'department_id');
    }


    public function workflows()
    {
        return $this->hasMany(Workflow::class, 'department_id');
    }

    /**
     * Helper methods
     */

    public function getRoles()
    {
        return [
            'sef-' . $this->slug,
            'angajat-' . $this->slug,
        ];
    }

    public function getAncestorsAndSelfRoles()
    {
        $roles = [];
        foreach ($this->ancestorsAndSelf()->get() as $department) {
            $roles[] = 'sef-' . $department->slug;
            if ($this->id == $department->id) {
                $roles[] = 'angajat-' . $department->slug;
            }
        }
        return $roles;
    }
}
