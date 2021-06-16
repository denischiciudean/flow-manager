<?php


namespace App\StateTrack;


class UserStateTrack
{
    public const USER_MENTION = 'user_mention';
    public const USER_REPLY = 'user_reply';
    public const USER_INVITED = 'user_invited';
    public const USER_LOGGED_IN = 'user_logged_in';
    public const USER_ACTIVATED_2FA = 'user_activated_2fa';
    public const USER_FAILED_2FA = 'user_failed_2fa';
    public const USER_FAILED_LOGIN = 'user_failed_login';
    public const USER_LOGGED_OUT = 'user_logged_out';
    public const USER_SESSION_EXPIRED = 'user_session_expired';
    public const USER_ADDED_TO_DEPARTMENT = 'user_added_to_department';
    public const USER_REMOVED_TO_DEPARTMENT = 'user_removed_from_department';
    public const USER_GIVEN_ROLE = 'user_given_role';
    public const USER_REVOKED_ROLE = 'user_revoked_role';
}
