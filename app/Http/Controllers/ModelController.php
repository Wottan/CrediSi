<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * A generic controller for a given model class
 */
abstract class ModelController extends Controller
{
    private Model $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->model::all();
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
        return $this->model::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->model::findOrFail($id);
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
        return tap($this->model::findOrFail($id))->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->model::findOrFail($id)->delete();
    }
}
