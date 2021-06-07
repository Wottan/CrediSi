<?php

namespace App\Http\Controllers;

use App\Models\Shift;

class ShiftController extends ModelController
{
    protected function getModel()
    {
        return Shift::class;
    }

    /**
     * Evaluates schedules and retuns currently active shifts
     */
    public function active() {
        return [];
    }
}
