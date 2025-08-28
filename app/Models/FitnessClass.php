<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FitnessClass extends Model
{
    use HasFactory;
    protected $table = 'classes'; // Specify the table name if it's different


    protected $fillable = ['title', 'description', 'start_time', 'end_time', 'capacity'];

    public function bookings()
    {
        return $this->hasMany(ClassBooking::class, 'class_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'class_bookings');
    }
}
