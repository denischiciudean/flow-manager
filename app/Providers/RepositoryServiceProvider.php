<?php

namespace App\Providers;

use App\Repositories\Eloquent\UsersRepository;
use App\Repositories\UsersRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
    }
}
