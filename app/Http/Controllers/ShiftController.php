<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return Shift::with(['events','user'])->get(); //TODO recurrence
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Shift::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return tap(Shift::findOrFail($id))->update($request->all());
    }
}
