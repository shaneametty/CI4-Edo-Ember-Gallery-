<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function dashboard(): string
    {
        return view('admin/dashboard');
    }

    public function users(): string
    {
        return view('admin/users');
    }

    public function users_create(): string
    {
        return view('admin/users_create');
    }

    public function users_update(): string
    {
        return view('admin/users_update');
    }
}
