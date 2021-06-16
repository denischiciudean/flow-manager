<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // View Nova Permission
        Permission::updateOrCreate(
            [
                'slug' => 'viewNova'
            ],
            [
                'name' => 'View Nova',
                'guard_name' => 'web'
            ]
        );

        // View Nova Permission
        Permission::updateOrCreate(
            [
                'slug' => 'invite_users_global'
            ],
            [
                'name' => 'Invite Users Global',
                'guard_name' => 'web'
            ]
        );

        // View Nova Permission
        Permission::updateOrCreate(
            [
                'slug' => 'invite_users_department'
            ],
            [
                'name' => 'Invite Users Department',
                'guard_name' => 'web'
            ]
        );


    }
}
