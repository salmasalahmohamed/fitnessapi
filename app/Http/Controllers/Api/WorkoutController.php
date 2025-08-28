<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workout;

class WorkoutController extends Controller
{
    public function index()
    {
        return Workout::with('exercises')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'total_duration' => 'required|integer',
            'total_calories' => 'required|integer',
        ]);

        $workout = Workout::create($request->all());

        return response()->json($workout, 201);
    }

    public function show($id)
    {
        return Workout::with('exercises')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $workout = Workout::findOrFail($id);
        $workout->update($request->all());

        return response()->json($workout);
    }

    public function destroy($id)
    {
        Workout::destroy($id);
        return response()->json(null, 204);
    }
}
