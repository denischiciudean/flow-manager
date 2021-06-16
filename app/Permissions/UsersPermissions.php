<?php


namespace App\Permissions;


use function PHPUnit\Framework\returnArgument;

class UsersPermissions
{

    public const INVITE_USER = 'invite_user_';

    /**
     * @param string $department
     * @return string
     */
    public static function INVITE_USER(string $department): string
    {
        return self::INVITE_USER . $department;
    }

    public static function DISPLAY_INVITE_USER(string $department): string
    {
        return 'Invite User ' . $department;
    }
}
