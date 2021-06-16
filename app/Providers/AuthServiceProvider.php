<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\DepartmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::define('check-department', [DepartmentPolicy::class, 'checkDepartment']);
//        Gate::before(function (User $user) {
//            if ($user->hasRole('webmaster')) {
//                return true;
//            }
//        });
        //
    }
}
