<?php


namespace App\StateTrack;


use Illuminate\Support\Facades\Auth;

trait UserStateTrait
{
    public function track_logout()
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => UserStateTrack::USER_LOGGED_OUT,
            'note' => 'User logged out',
            'data' => [
                'current_time' => now()->timestamp
            ]
        ]);
    }

    public function track_nova_login()
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => UserStateTrack::USER_LOGGED_IN,
            'note' => 'User nova login',
            'data' => [
                'current_time' => now()->timestamp
            ]
        ]);
    }

    public function track_given_role($role)
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => UserStateTrack::USER_GIVEN_ROLE,
            'note' => 'User is ' . $role->display_name,
            'data' => [
                'current_time' => now()->timestamp,
                'role_id' => $role->id,
                'admin_id' => Auth::check() ? Auth::user()->id : null
            ]
        ]);
    }

    public function track_revoked_role($role)
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => UserStateTrack::USER_REVOKED_ROLE,
            'note' => 'User revoked ' . $role->display_name,
            'data' => [
                'current_time' => now()->timestamp,
                'role_id' => $role->id,
                'admin_id' => Auth::check() ? Auth::user()->id : null
            ]
        ]);
    }

    public function track_added_department($department)
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => UserStateTrack::USER_GIVEN_ROLE,
            'note' => 'User added to ' . $department->name,
            'data' => [
                'current_time' => now()->timestamp,
                'role_id' => $department->id,
                'admin_id' => Auth::check() ? Auth::user()->id : null
            ]
        ]);
    }

    public function track_removed_department($department)
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => UserStateTrack::USER_GIVEN_ROLE,
            'note' => 'User removed from ' . $department->name,
            'data' => [
                'current_time' => now()->timestamp,
                'role_id' => $department->id,
                'admin_id' => Auth::check() ? Auth::user()->id : null
            ]
        ]);
    }

    public function track_invited_user($user)
    {
        $this->stateChanges()->create([
            'user_id' => $this->id,
            'type' => UserStateTrack::USER_INVITED,
            'note' => 'User invited ' . $user->email,
            'data' => [
                'current_time' => now()->timestamp,
                'user_id' => $user->id,
                'admin_id' => $this->id
            ]
        ]);
    }
}
