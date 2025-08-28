<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'description', 'calories_per_minute'];

    public function workouts()
    {
        return $this->belongsToMany(Workout::class)->withPivot('duration', 'calories_burned')->withTimestamps();
    }
}
