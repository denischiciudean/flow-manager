<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Permissions\DepartmentsPermissions;
use App\Permissions\RolePermissions;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = Permission::all();

        $role = $this->createRole('webmaster');

        $this->dummyRoles();

        $permissions
            ->filter(fn($it) => in_array($it->slug, ['viewNova', 'invite_users_global']))
            ->each(fn($permission) => $role->givePermissionTo($permission->slug));
    }

    private function createRolePermissions(Role $role)
    {
        return Permission::firstOrCreate(
            [
                'name' => RolePermissions::ASSIGN_ROLE($role->name)
            ],
            [
                'display_name' => RolePermissions::DISPLAY_ASSIGN_ROLE($role->name),
                'guard_name' => 'web'
            ]
        );
    }

    private function assignBossPermissions(Role $role, Department $department)
    {
        $role->givePermissionTo(DepartmentsPermissions::VIEW($department->slug));
//        $role->givePermissionTo(DepartmentsPermissions::CREATE_TASK($department->slug));
//        $role->givePermissionTo(DepartmentsPermissions::ASSIGN_TASK($department->slug));
    }

    private function assignEmployeePermissions(Role $role, Department $department)
    {
        $role->givePermissionTo(DepartmentsPermissions::VIEW($department->slug));
    }

    private function createRole(string $name): Role
    {
        $role = Role::firstOrCreate(
            [
                'name' => \Str::of($name)->slug()
            ],
            [
                'display_name' => $name,
                'guard_name' => 'web'
            ]
        );
        $this->createRolePermissions($role);
        return $role;
    }

    public function dummyRoles()
    {
        $departments = Department::where('parent_id', null)->whereNotIn('slug', ['webmaster'])->get();
        foreach ($departments as $department) {

            $sef = $this->createRole("Sef $department->name");
            $angajat = $this->createRole("Angajat $department->name");

            $this->assignBossPermissions($sef, $department);
            $this->assignEmployeePermissions($angajat, $department);

            $sef->givePermissionTo(RolePermissions::ASSIGN_ROLE($angajat->name));

            if ($department->has_children) {
                foreach ($department->descendants()->get() as $dep) {
                    $_sef = $this->createRole("Sef $dep->name");
                    $_angajat = $this->createRole("Angajat $dep->name");

                    $this->assignBossPermissions($_sef, $dep);
                    $this->assignBossPermissions($sef, $dep);

                    $this->assignEmployeePermissions($_angajat, $dep);

                    $roles = $dep->descendants()->get()->map(fn($it) => [$this->createRole("Sef $it->name"), $this->createRole("Angajat $it->name")])->flatten();

                    $dep->descendants()->get()->map(fn($it) => $this->assignBossPermissions($_sef, $it));

                    if ($roles->count()) {
                        foreach ($roles as $r) {
                            $_sef->givePermissionTo(RolePermissions::ASSIGN_ROLE($r->name));
                        }
                    }

                    $_sef->givePermissionTo(RolePermissions::ASSIGN_ROLE($_angajat->name));
                    $sef->givePermissionTo(RolePermissions::ASSIGN_ROLE($_sef->name));
                    $sef->givePermissionTo(RolePermissions::ASSIGN_ROLE($_angajat->name));

                }
            }
        }
    }

}
