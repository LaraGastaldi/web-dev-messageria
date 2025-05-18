<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        $toReturn = User::create($data);

        if ($toReturn) {
            return response()->json([
                'token' => auth()->attempt([$data['email'], $data['password']]),
                'message' => __('api.user.register.success')
            ], 201);
        }
        return response()->json([
            'error' => __('api.user.register.failed')
        ], 401);
    }

    protected function updateProfilePic(Request $request)
    {
        $file = $request->validate([
            'file' => 'image|required|dimensions:ratio=1/1'
        ]);

        $user = User::findOrFail($request->user_id);
        if (auth()->user()->id != $user->id) {
            abort(403);
        }
        $path = base64_encode($user->id . '_' . uniqid('img_', true));
        if (File::put($path, $file['file'])) {
            $user->update([
                'avatar' => $path
            ]);
            return response()->json([
                'message' => __('api.user.avatar.success')
            ],200);
        }
        return response()->json([
            'error'=> __('api.user.avatar.failed')
        ],422);
    }
}