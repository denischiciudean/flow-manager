<?php


namespace App\StateTrack;


class TaskStateTrack extends StateTrack
{
    public const TASK_CREATE = 'task_created';
    public const TASK_UPDATED = 'task_updated';
    public const TASK_COMPLETED = 'task_completed';
    public const TASK_DUPLICATED = 'task_duplicated';
    public const TASK_ADVANCED = 'task_advanced';
    public const TASK_STATUS_UPDATE = 'task_status_updated';
    public const TASK_SPLIT = 'task_split';

    /**
     *
     * IF FROM A A NEW TASK IS CREATED B
     *  A = OG
     *  B = SPLIT
     *
     * THE DATA WE ALSO STORE THE TYPE SO WE KNOW THE WHETHER THE STATE CHANGE IS THE OG (SPLIT INTO)
     * OR THE RESULT OF THE SPLIT (SPLIT FROM)
     *
     * The from origin
     */
    public const TASK_SPLIT_TYPE_OG = 'og';
    /**
     * The from split
     */
    public const TASK_SPLIT_TYPE_SPLIT = 'split';
}
