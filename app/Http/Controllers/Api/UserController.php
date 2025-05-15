<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $resource = UserResource::class;
    protected function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:dns|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        return User::create($data);
    }
}