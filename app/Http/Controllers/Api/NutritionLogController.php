<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NutritionLog;
use Illuminate\Http\Request;

class NutritionLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return NutritionLog::where('user_id', auth()->id())->get();
    }

    public function store(Request $r) {
        return NutritionLog::create($r->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'meal_type' => 'required',
            'food_name' => 'required',
            'calories' => 'required|integer',
            'protein' => 'nullable|numeric',
            'carbs' => 'nullable|numeric',
            'fats' => 'nullable|numeric',
        ]));
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
