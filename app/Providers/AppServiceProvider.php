<?php

namespace App\Providers;

use App\Http\Controllers\Auth\NovaLogin;
use App\Twilio\TwilioWrapper;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Http\Controllers\LoginController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        RateLimiter::for("login", function () {
            Limit::perMinute(500);
        });

        $this->app->bind(TwilioWrapper::class, fn() => new TwilioWrapper(
            config('services.twilio.sid'),
            config('services.twilio.token'),
            config('services.twilio.messaging_sid')
        ));

        $this->app->bind(LoginController::class, NovaLogin::class);

    }
}
