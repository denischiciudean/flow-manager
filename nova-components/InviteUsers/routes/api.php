<?php

use App\Mail\InviteUserMail;
use App\Models\Department;
use App\Models\Role;
use App\Permissions\RolePermissions;
use App\Permissions\UsersPermissions;
use App\Repositories\UsersRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/user-departments', function (Request $request) {
    $user = $request->user();
    $departments = Department::all();
    return JsonResource::make($user->hasRole('Webmaster') ? $departments : $departments->filter(fn($it) => $user->can(UsersPermissions::INVITE_USER($it->slug))));
});

Route::get('/user-roles', function (Request $request) {
    $user = $request->user();
    $roles = Role::all();
    return JsonResource::make($user->hasRole('Webmaster') ? $roles : $roles->filter(fn($it) => $user->can(RolePermissions::ASSIGN_ROLE($it->name))));
});

Route::post('/invite-user', function (Request $request, UsersRepositoryInterface $usersRepository) {
    $data = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|unique:users,phone_number',
        'department_id' => 'required|integer|exists:departments,id'
    ]);
    [$user, $pass] = $usersRepository->createInvite($data);
    Auth::user()->track_invited_user($user);
    dispatch(fn() => \Illuminate\Support\Facades\Mail::to($user)->send(new InviteUserMail($user, $pass)))->afterResponse();
    return JsonResource::make(['success' => 'User Created and email sent']);
});
