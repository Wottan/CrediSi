<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * A generic controller for a given model class
 */
abstract class ModelController extends Controller
{
    abstract protected function getModel();

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->getModel()::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json('not implemented', 500);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->getModel()::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->getModel()::findOrFail($id);
    }

    /**
     * Show the form editing the specified resource.
     */
    public function edit()
    {
        return response()->json('not implemented', 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return tap($this->getModel()::findOrFail($id))->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->getModel()::findOrFail($id)->delete();
    }
}
