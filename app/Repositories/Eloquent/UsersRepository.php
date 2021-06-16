<?php


namespace App\Repositories\Eloquent;


use App\Models\Department;
use App\Models\User;
use App\Repositories\UsersRepositoryInterface;
use Illuminate\Support\Str;

class UsersRepository implements UsersRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function createInvite(array $data): array
    {
        $pass = Str::random(8);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Hash::make($pass),
            'phone_number' => $data['phone']
        ]);

        $department = Department::find($data['department_id']);


        $user->departments()->attach($department);

        $user->track_added_department($department);

        return [$user, $pass];
    }
}
