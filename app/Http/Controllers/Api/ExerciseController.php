<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{

    public function index() { return Exercise::all(); }

    public function store(Request $r) {
         $exercise=Exercise::create($r->validate([
            'name' => 'required', 'category' => 'nullable',
            'description' => 'nullable', 'calories_per_minute' => 'nullable|numeric',
        ]));
        return response()->json($exercise, 201);

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
