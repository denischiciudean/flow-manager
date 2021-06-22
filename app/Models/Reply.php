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
        return [
            'created_by' => [
                'id' => $this->user->id,
                'name' => $this->user->name
            ],
            'task' => [
                'id' => $this->task->first()->id,
                'title' => $this->task->first()->title
            ],
            'date' => $this->created_at->format('d.m.Y H:s'),
            'content' => $this->content,
            'message_id' => $this->id,
            'href' => route('task.view', ['task_id' => $this->task->first()->id, 'task_slug' => ($this->task->first()->slug ?? $this->task->first()->title) ?? 'task']),
            'created_at' => $this->created_at->timestamp,
        ];
    }
}
