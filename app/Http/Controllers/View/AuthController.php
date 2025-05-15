<?php

namespace App\Http\Controllers\View;

class AuthController
{
    public function index()
    {
        return view('auth.login');
    }
}