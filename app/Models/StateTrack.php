<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateTrack extends Model
{
    use HasFactory;

    protected $table = 'state_track';

    protected $guarded = [];

    protected $casts = [
        'data' => 'json'
    ];

    public function state_trackable()
    {
        return $this->morphToMany(User::class, 'state_trackable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formatForView()
    {
        Carbon::setlocale('ro');
        return [
            'id' => $this->id,
            'by' => $this->user?->name,
            'created_at' => $this->created_at->format('D, d M, H:i'),
            'type' => $this->type,
            'note' => $this->note
        ];
    }

}
