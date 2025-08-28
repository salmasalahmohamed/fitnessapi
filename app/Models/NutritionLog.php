<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'date', 'meal_type', 'food_name',
        'calories', 'protein', 'carbs', 'fats'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
