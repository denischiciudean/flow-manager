<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => ['auth', 'verified']], function () {

    #You need two factor authentication to access the app
    Route::get('/activare-2fa', [UserController::class, 'activateTfa'])->name('user.activate2fa');

    Route::post('/verify-phone', [UserController::class, 'verifyPhone'])->name('user.verify_phone');
    Route::post('/verify-code', [UserController::class, 'verifyPhoneCode'])->name('user.verify_code');
    # After 2fa activated you can access the app normally, if not, you have to activate it
    Route::group(['middleware' => ['2fa_enabled']], function () {

        Route::group(['prefix' => '/contul-meu/'], function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index');
            Route::get('/setari', [UserController::class, 'settings'])->name('user.index');
        });

        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

    });
});

require __DIR__ . '/auth.php';
