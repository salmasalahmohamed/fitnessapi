<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgressLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressLogController extends Controller
{
    public function index(){
        return ProgressLog::where('user_id',Auth::user()->id);
    }
    public function store(Request $r) {
    return ProgressLog::create($r->validate([
        'user_id' => 'required|exists:users,id',
        'date' => 'required|date',
        'weight' => 'required|numeric',
        'body_fat_percentage' => 'nullable|numeric',
        'notes' => 'nullable|string',
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
