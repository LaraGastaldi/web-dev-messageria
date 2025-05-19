<?php

namespace App\Http\Controllers\View;

class AuthController
{
    public function login()
    {
        return view('pages.login');
    }

    public function register()
    {
        return view('pages.register');
    }
}