<?php


namespace App\Permissions;


use function PHPUnit\Framework\returnArgument;

class DepartmentsPermissions
{

    public const VIEW = 'view_';
    public const ASSIGN_TASK = 'assign_task_';
    public const CREATE_TASK = 'create_task_';

    /**
     * @param string $department
     * @return string
     */
    public static function VIEW(string $department): string
    {
        return self::VIEW . $department;
    }

    public static function DISPLAY_VIEW(string $name): string
    {
        return 'View ' . $name;
    }

    /**
     * @param string $department
     * @return string
     */
    public static function ASSIGN_TASK(string $department): string
    {
        return self::ASSIGN_TASK . $department;
    }

    public static function DISPLAY_ASSIGN_TASK(string $name): string
    {
        return 'Assign Task - ' . $name;
    }

    /**
     * @param string $department
     * @return string
     */
    public static function CREATE_TASK(string $department): string
    {
        return self::CREATE_TASK . $department;
    }

    public static function DISPLAY_CREATE_TASK(string $name): string
    {
        return 'Create Task - ' . $name;
    }
}
