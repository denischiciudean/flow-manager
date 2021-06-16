<?php

namespace App\Models;

use App\StateTrack\UserStateTrait;
use App\Traits\Models\UserTwilioTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory,
        Notifiable,
        UserTwilioTrait,
        HasPermissions,
        HasRoles,
        UserStateTrait;


    protected $with = ['primary_department'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'user_departments', 'user_id', 'department_id');
    }

    public function primary_department()
    {
        return $this->belongsToMany(Department::class, 'user_departments', 'user_id', 'department_id')->withPivot(['primary'])->wherePivot('primary', true);
    }

    public function stateChanges()
    {
        return $this->morphToMany(StateTrack::class, 'state_trackable');
    }

    /**
     * Assign the given role to the model.
     *
     * @param array|string|\Spatie\Permission\Contracts\Role ...$roles
     *
     * @return $this
     */
    public function assignRole(...$roles)
    {
        $roles = collect($roles)
            ->flatten()
            ->map(function ($role) {
                if (empty($role)) {
                    return false;
                }
                $role_model = $this->getStoredRole($role);
                /**
                 * Added track role
                 */
                $this->track_given_role($role_model);
                return $role_model;
            })
            ->filter(function ($role) {
                return $role instanceof Role;
            })
            ->each(function ($role) {
                $this->ensureModelSharesGuard($role);
            })
            ->map->id
            ->all();

        $model = $this->getModel();

        if ($model->exists) {
            $this->roles()->sync($roles, false);
            $model->load('roles');
        } else {
            $class = \get_class($model);

            $class::saved(
                function ($object) use ($roles, $model) {
                    $model->roles()->sync($roles, false);
                    $model->load('roles');
                }
            );
        }

        $this->forgetCachedPermissions();

        return $this;
    }

    public function removeRole($role)
    {
        $role_model = $this->getStoredRole($role);

        $this->track_revoked_role($role_model);

        $this->roles()->detach($role_model);

        $this->load('roles');

        $this->forgetCachedPermissions();

        return $this;
    }



}
