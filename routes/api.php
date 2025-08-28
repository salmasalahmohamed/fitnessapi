<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassBookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::apiResource('workouts', App\Http\Controllers\Api\WorkoutController::class);
Route::apiResource('exercises', App\Http\Controllers\Api\ExerciseController::class);
Route::apiResource('nutrition-logs', App\Http\Controllers\Api\NutritionLogController::class);
Route::apiResource('goals', App\Http\Controllers\Api\GoalController::class);
Route::apiResource('progress-logs', App\Http\Controllers\Api\ProgressLogController::class);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/bookings', [ClassBookingController::class, 'index']);
Route::post('/bookings', [ClassBookingController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/bookings/{id}', [ClassBookingController::class, 'destroy']);
