<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Resources\UserResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $resource = UserResource::class;

    protected function updateAvatar(Request $request)
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