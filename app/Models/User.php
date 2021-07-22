<?php

namespace App\Models;

use App\StateTrack\UserStateTrait;
use App\Traits\Models\UserTwilioTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use function get_class;

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


    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::creating(function ($model) {
            $model->username = (string)Str::of($model->name)->slug();
        });

    }

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

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function mentions()
    {
        return $this->hasMany(Mention::class);
    }

    /**
     * Assign the given role to the model.
     *
     * @param array|string|Role ...$roles
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
            $class = get_class($model);

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

    public function mentionableUsers($workflow = null)
    {
        $p_department = $this->primary_department->first();
        /**
         * here the logic can become more complicated based on permissions
         */
        $users = Department::whereIn('id',
            $workflow
                ->steps
                ->pluck('pivot.resolution_department_id')
                ->unique()
                ->toArray())
            ->get()
            ->pluck('users')
            ->flatten();

        return collect([
            ...$p_department->users,
            ...($workflow ? $users : collect([]))
        ])->unique->id;
    }

    public function formatForSelect()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username
        ];
    }
}
