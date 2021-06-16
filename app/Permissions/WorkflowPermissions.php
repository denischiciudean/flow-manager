<?php


namespace App\Permissions;


class WorkflowPermissions
{
    public const CREATE = 'create_workflow_';

    /*
     * CREATE THE WORKFLOW
     */
    public static function CREATE(string $flow)
    {
        return self::CREATE . "{$flow}";
    }

    public static function DISPLAY_CREATE(string $flow)
    {
        return 'Create Workflow ' . $flow;
    }
}
