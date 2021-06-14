<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Models\Label;

class LabelController extends ModelController
{

    protected function getModel()
    {
        return Label::class;
    }

    public function upsert(Request $request)
    {
        $labels = $request->all();
        /**
         * First argument the values to insert or update, second argument lists the column(s) that uniquely identify records
         * Third argument is an array of the columns that should be updated
         */
        Label::upsert($labels, ['text'], ['text', 'color']);
        return response()->json(Label::all());
    }
}