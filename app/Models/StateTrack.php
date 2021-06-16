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

}
