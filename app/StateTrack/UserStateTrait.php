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
            'note' => 'Utilizator delogat',
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
            'note' => 'Utilizator logat | nova',
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
            'note' => 'Utilizatorul a primit rolul ' . $role->display_name,
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
            'note' => 'Utilizatorului i s-a revocat rolul ' . $role->display_name,
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
            'note' => 'Utilizator adaugat in departamentul ' . $department->name,
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
            'note' => 'Utilizatorul a fost inlaturat de la departamentul ' . $department->name,
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
            'note' => 'Utilizatorul a fost invitat sa isi creeze cont : ' . $user->email,
            'data' => [
                'current_time' => now()->timestamp,
                'user_id' => $user->id,
                'admin_id' => $this->id
            ]
        ]);
    }
}
