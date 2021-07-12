<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\TasksController;
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
            Route::get('/setari', [UserController::class, 'settings'])->name('user.settings');
        });
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/search-tasks/{search_term}', [DashboardController::class, 'search'])->name('search');

        Route::group(['prefix' => '/nota-noua/'], function () {
            Route::get('departament', [TasksController::class, 'selectDepartment'])->name('task.create.select_department');
            Route::post('post/creaza/{workflow_id}/{slug}', [TasksController::class, 'createTask'])->name('task.create.process');
            Route::get('creaza/{workflow_id}/{workflow_slug}', [TasksController::class, 'create'])->name('workflow.create');
            Route::get('{department_id}/{department_slug}/tip-nota', [TasksController::class, 'selectWorkflow'])->name('task.create.select_workflow');
        });

        Route::get('/mesagerie', [MessagesController::class, 'index'])->name('messages.index');

        Route::get('/view-file/{step}/{data_key}/{file}', [TasksController::class, 'viewFile'])->name('task.viewFile');

        Route::group(['prefix' => '/note'], function () {
            Route::post('/{task_id}/{task_slug}/reatribuie', [TasksController::class, 'reassign'])->name('task.reassign');
            Route::get('/{task_id}/{task_slug}/', [TasksController::class, 'view'])->name('task.view');
            Route::post('/finish-step', [TasksController::class, 'advanceStep'])->name('tasks.finish_step');
        });


        Route::group(['prefix' => 'api/'], function () {
            Route::get('/mentionable-users', [
                ApiController::class,
                'mentionableUsers'
            ]);

            Route::post('/add-comment', [ApiController::class, 'addComment']);
        });
    });
});

require __DIR__ . '/auth.php';
