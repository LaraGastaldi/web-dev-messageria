<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillabe = [
        'status',
        'user_id',
        'to_id',
    ];
}