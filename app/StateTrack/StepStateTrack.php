<?php


namespace App\StateTrack;


class StepStateTrack extends StateTrack
{
    public const STEP_INITIATED = 'step_initiated';
    public const STEP_COMPLETED = 'step_completed';
    public const STEP_ASSIGNED = 'step_assigned';
    public const STEP_SEEN = 'step_seen';
    public const STEP_CREATED = 'step_created';
}
