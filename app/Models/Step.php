<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $table = 'steps';
    protected $guarded = [];

    protected $casts = [
        'validation' => 'json'
    ];

    public function workflows()
    {
        return $this->belongsToMany(Workflow::class, 'workflow_steps', 'workflow_id', 'step_id');
    }
}
