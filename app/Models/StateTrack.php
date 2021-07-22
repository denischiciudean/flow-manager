<?php

namespace App\Models;

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


    public function formatForView()
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at->locale('ro')->format('D m'),
            'type' => $this->type,
            'note' => $this->note
        ];
    }

}
