<?php

namespace App\Http\Controllers;

use App\Models\Shift;

class ShiftController extends ModelController
{
    protected function getModel()
    {
        return Shift::class;
    }
}
