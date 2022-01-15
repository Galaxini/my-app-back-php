<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Services\ValidationRules;
use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}