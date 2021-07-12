<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'replies';

    protected $guarded = [];

    protected $casts = [
        'content' => 'json'
    ];

    public function task()
    {
        return $this->morphedByMany(Task::class, 'replyable', 'replyables');
    }

    public function mentions()
    {
        return $this->hasMany(Mention::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formatForDashboard()
    {
        $task = $this->task->first();

        return [
            'created_by' => [
                'id' => $this->user->id,
                'name' => $this->user->name
            ],
            'task' => [
                'id' => $task ? $this->task->first()?->id : '',
                'title' => $task ? $this->task->first()?->title : ''
            ],
            'date' => $this->created_at->format('d.m.Y H:s'),
            'content' => $this->content,
            'message_id' => $this->id,
            'href' => route('task.view', ['task_id' => $task ? $this->task->first()->id : '', 'task_slug' => $task ? ($this->task->first()->slug ?? $this->task->first()->title) : 'task']),
            'created_at' => $this->created_at->timestamp,
        ];
    }

    public function formatForMessages()
    {
        return [
            'href' => route('task.view', ['task_id' => $this->task->first()->id, 'task_slug' => $this->task->first()->slug]),
            'from' => [
                'name' => $this->user->name,
                'since' => (int)((now()->timestamp - $this->created_at->timestamp) / 60)
            ],
            'message_content' => $this->content,
            'task' => [
                'title' => $this->task->first()->title,
                'task_series' => $this->task->first()->series
            ]
        ];
    }
}
