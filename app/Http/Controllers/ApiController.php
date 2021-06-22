<?php

namespace App\Http\Controllers;

use App\Components\CommentsHelper;
use App\Models\Mention;
use App\Models\Reply;
use App\Models\Task;
use App\Models\Workflow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiController extends Controller
{
    public function mentionableUsers(Request $request)
    {
        $workflow = null;

        if ($request->has('workflow_id')) {
            $workflow = Workflow::find($request->get('workflow_id'));
        }

        return JsonResource::make($request->user()->mentionableUsers($workflow)->map->formatForSelect());
    }

    public function addComment(Request $request)
    {
        $content = $request->get('content');

        $task_id = $request->get('task_id');

        $mentions = [];

        CommentsHelper::extract_mentions_from_json($content, $mentions);

        $mention_users = User::whereIn('username', $mentions)->get();

        $user = $request->user();
        $task = Task::find($task_id);

        if (!$task) {
            return JsonResource::make([
                'status' => 'error',
                'message' => 'Unknown Task'
            ]);
        }

        $reply = Reply::create([
            'user_id' => $user->id,
            'content' => $content
        ]);

        $task->comments()->attach($reply);

        foreach ($mention_users as $mentioned_user) {
            Mention::create([
                'user_id' => $mentioned_user->id,
                'reply_id' => $reply->id
            ]);
        }

        return JsonResource::make([
            'status' => 'success'
        ]);

    }
}
