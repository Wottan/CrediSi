<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends ModelController
{
    public function __construct() {
        parent::__construct(new User());
    }
}
