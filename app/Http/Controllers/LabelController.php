<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Database\Eloquent\Model;

class LabelController extends ModelController
{
    public function __construct() {
        parent::__construct(new Label());
    }
}
