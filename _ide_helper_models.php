<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Department
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property bool $has_children
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $slug
 * @property string|null $doc_series
 * @property-read \Illuminate\Database\Eloquent\Collection|Department[] $children
 * @property-read int|null $children_count
 * @property-read Department|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workflow[] $workflows
 * @property-read int|null $workflows_count
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department breadthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department depthFirst()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department getExpressionGrammar()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department hasChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department hasParent()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department isLeaf()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department isRoot()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department newModelQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department newQuery()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department query()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department tree($maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department treeOf(callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department whereDeletedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department whereDepth($operator, $value = null)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department whereDocSeries($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department whereHasChildren($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department whereId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department whereName($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department whereParentId($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department whereSlug($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department whereUpdatedAt($value)
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Builder|Department withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mention
 *
 * @property int $id
 * @property int $reply_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Reply $reply
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Mention newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mention newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mention query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mention whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mention whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mention whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mention whereReplyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mention whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mention whereUserId($value)
 */
	class Mention extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $display_name
 * @property-read \Illuminate\Database\Eloquent\Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Reply
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property array $content
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Mention[] $mentions
 * @property-read int|null $mentions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $task
 * @property-read int|null $task_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reply query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reply whereUserId($value)
 */
	class Reply extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReplyReadReceipts
 *
 * @property int $id
 * @property int $reply_id
 * @property int $user_id
 * @property string|null $read_at
 * @property string|null $seen_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ReplyReadReceipts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReplyReadReceipts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReplyReadReceipts query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReplyReadReceipts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReplyReadReceipts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReplyReadReceipts whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReplyReadReceipts whereReplyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReplyReadReceipts whereSeenAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReplyReadReceipts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReplyReadReceipts whereUserId($value)
 */
	class ReplyReadReceipts extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $display_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StateTrack
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $type
 * @property string $note
 * @property array $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $state_trackable
 * @property-read int|null $state_trackable_count
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack query()
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StateTrack whereUserId($value)
 */
	class StateTrack extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Step
 *
 * @property int $id
 * @property string $name
 * @property string $type is GUI or BACKGROUND
 * @property string $component Can either be the UI component name OR it can be a invokable class for the background type
 * @property array $validation Validation refers to either the data that the GUI has to collect or the rezolution or the background job
 * @property bool $reusable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Workflow[] $workflows
 * @property-read int|null $workflows_count
 * @method static \Illuminate\Database\Eloquent\Builder|Step newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Step newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Step query()
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereComponent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereReusable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Step whereValidation($value)
 */
	class Step extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $department_id
 * @property int $workflow_id
 * @property int $created_by
 * @property string|null $title
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property string|null $completed_at
 * @property string|null $slug
 * @property string|null $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\TaskStep|null $currentStep
 * @property-read \App\Models\Department $department
 * @property-read \Illuminate\Database\Eloquent\Collection|Task[] $parent_split
 * @property-read int|null $parent_split_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StateTrack[] $stateChanges
 * @property-read int|null $state_changes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TaskStep[] $steps
 * @property-read int|null $steps_count
 * @property-read \App\Models\Workflow $workflow
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereWorkflowId($value)
 */
	class Task extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TaskSplit
 *
 * @property int $id
 * @property int $og_task_id
 * @property int|null $og_step_id
 * @property int $dest_task_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TaskSplit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskSplit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskSplit query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskSplit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskSplit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskSplit whereDestTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskSplit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskSplit whereOgStepId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskSplit whereOgTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskSplit whereUpdatedAt($value)
 */
	class TaskSplit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TaskStep
 *
 * @property int $id
 * @property int $task_id
 * @property int $step_id
 * @property int|null $assigned_to
 * @property bool $is_done
 * @property bool $is_current
 * @property string|null $completed_at
 * @property array|null $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User|null $assignedTo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StateTrack[] $stateChanges
 * @property-read int|null $state_changes_count
 * @property-read \App\Models\Step $step
 * @property-read \App\Models\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereAssignedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereIsCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereIsDone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereStepId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskStep whereUpdatedAt($value)
 */
	class TaskStep extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $phone_number
 * @property string|null $phone_verified_at
 * @property string|null $phone_code
 * @property string|null $username
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Department[] $departments
 * @property-read int|null $departments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Mention[] $mentions
 * @property-read int|null $mentions_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Department[] $primary_department
 * @property-read int|null $primary_department_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $replies
 * @property-read int|null $replies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StateTrack[] $stateChanges
 * @property-read int|null $state_changes_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Workflow
 *
 * @property int $id
 * @property int $department_id
 * @property string $name
 * @property string $status
 * @property int $expiration_in
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $slug
 * @property-read \App\Models\Department $department
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Step[] $steps
 * @property-read int|null $steps_count
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow query()
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow whereExpirationIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Workflow whereUpdatedAt($value)
 */
	class Workflow extends \Eloquent {}
}

