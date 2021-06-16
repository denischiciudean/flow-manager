<?php


namespace App\Permissions;


use App\Models\Role;

class RolePermissions
{
    public const ASSIGN_ROLE = 'assign_role_';

    /**
     * @return string
     */
    public static function ASSIGN_ROLE(string $role): string
    {
        return self::ASSIGN_ROLE . $role;
    }

    public static function DISPLAY_ASSIGN_ROLE(string $role): string
    {
        return 'Assign Role ' . $role;
    }
}
