<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;
    public function toArray(Request $request)
    {
        return [
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}