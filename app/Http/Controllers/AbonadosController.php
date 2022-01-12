<?php

namespace App\Http\Controllers;

use App\Models\Abonado;

class AbonadosController extends ModelController
{
    protected function getModel()
    {
        return Abonado::class;
    }

    protected function with(): array
    {
        return ['province'];
    }
}
