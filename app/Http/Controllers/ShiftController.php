<?php

namespace App\Http\Controllers;

use App\Services\ShiftService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function syncLabels(Request $request, $id)
    {
        return $this->shiftService->syncLabels($id, $request->all());
    }

    /**
     * All shifts actives
     */
    public function active(Request $request)
    {
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
