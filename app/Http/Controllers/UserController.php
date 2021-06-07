<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends ModelController
{
    protected function getModel()
    {
        return User::class;
    }
}
