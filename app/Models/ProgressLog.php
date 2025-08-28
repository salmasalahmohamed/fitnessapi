<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'weight', 'body_fat_percentage', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
