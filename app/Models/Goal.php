<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'goal_type', 'target_weight',
        'target_calories', 'target_workout_mins', 'deadline'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
