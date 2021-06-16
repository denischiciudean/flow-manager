<?php


namespace App\Permissions;


class TaskPermissions
{
    public const VIEW = 'view_task_';

    public static function VIEW(string $task_slug)
    {
        return self::VIEW . $task_slug;
    }

    public static function DISPLAY_VIEW(string $task_slug)
    {
        return "View Task - " . $task_slug;
    }
}
