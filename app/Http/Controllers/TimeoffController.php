<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TimeOff;

class TimeoffController extends ModelController
{
    protected function getModel()
    {
        return TimeOff::class;
    }

    protected function with(): array
    {
        return ['user'];
    }
}