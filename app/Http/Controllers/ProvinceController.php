<?php

namespace App\Http\Controllers;

use App\Models\Abonado;
use App\Models\Provinces;

class ProvinceController extends ModelController
{
    protected function getModel()
    {
        return Provinces::class;
    }
}
