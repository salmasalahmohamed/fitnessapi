<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassBooking;
use App\Models\FitnessClass;

class ClassBookingController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->load('classBookings.fitnessClass');
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
        ]);

        $fitnessClass = FitnessClass::findOrFail($request->class_id);

        if ($fitnessClass->bookings()->count() >= $fitnessClass->capacity) {
            return response()->json(['message' => 'Class is full'], 403);
        }

        $exists = ClassBooking::where('user_id', $request->user()->id)
            ->where('class_id', $request->class_id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already booked'], 409);
        }

        $booking = ClassBooking::create([
            'user_id' => $request->user()->id,
            'class_id' => $request->class_id,
        ]);

        return response()->json($booking, 201);
    }

    public function destroy($id, Request $request)
    {
        $booking = ClassBooking::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $booking->delete();

        return response()->json(['message' => 'Booking cancelled']);
    }

}
