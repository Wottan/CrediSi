<?php

namespace App\Http\Controllers;

use App\Services\ShiftService;
use Illuminate\Http\Request;
class ShiftController extends Controller
{

    public function __construct(ShiftService $shiftService)
    {
        $this->shiftService = $shiftService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->shiftService->all();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->shiftService->get($id, request()->get('date'));
    }

    /**
     * List of shifts for agiven user
     */
    public function forUser($id)
    {
        return $this->shiftService->forUser($id, request()->get('date'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'start' => 'required',
        ]);
        return $this->shiftService->create($request->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        return $this->shiftService->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->shiftService->delete($id);
    }

    /**
     * 
     */
    public function syncLabels(Request $request, $id)
    {
        return $this->shiftService->syncLabels($id, $request->all());
    }

    /**
     * All shifts actives
     */
    public function active(Request $request)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d H:i',
        ]);
        return $this->shiftService->active($request->get('date'));
    }

    /**
     * All shifts of the date
     */
    public function today()
    {
        return $this->shiftService->today();
    }
}
