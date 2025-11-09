<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index(): string
    {
        return view('users/landingPage');
    }

    public function login(): string
    {
        return view('users/login');
    }

    public function signup(): string
    {
        return view('users/signup');
    }
}
