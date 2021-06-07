<?php

namespace App\Http\Controllers;

use App\Models\Label;

class LabelController extends ModelController
{

    protected function getModel()
    {
        return Label::class;
    }
}
