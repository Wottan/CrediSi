<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * A generic controller for a given model class
 */
abstract class ModelController extends Controller
{
    abstract protected function getModel();

    /**
     * Override to include related entities
     */
    protected function with(): array
    {
        return [];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->getModel()::with($this->with())->get();
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
        $model = $this->getModel()::create($request->all());
        return $this->getModel()::with($this->with())->findOrFail($model->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->getModel()::with($this->with())->findOrFailfindOrFail($id);
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
        $model = tap($this->getModel()::findOrFail($id))->update($request->all());
        return $this->getModel()::with($this->with())->findOrFail($model->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->getModel()::findOrFail($id)->delete();
    }
}
