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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    public function sync(Request $request, $id)
    {
        return $this->shiftService->sync($id, $request->all());
    }

    /**
     * All shifts actives
     */
    public function active()
    {
        return $this->shiftService->shiftsActive();
    }

    /**
     * All shifts of the date
     */
    public function today()
    {
        return $this->shiftService->shiftsToday();
    }

    /**
     * All shifts by datetime
     */
    public function byDateTime($date)
    {
        return $this->shiftService->byDateTime($date);
    }
}
