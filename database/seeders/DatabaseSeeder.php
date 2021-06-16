<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RolesSeeder::class]);

        if (!Permission::all()->count()) {
            $this->call([PermissionsSeeder::class]);
        }


        if (!Role::all()->count()) {
            $this->call([RolesSeeder::class]);
        }

        if (!Department::all()->count()) {
            $this->call([DepartmentsSeeder::class]);
        }

    }
}
