<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'username',
        'name',
        'email',
        'password',
    ];

    public $incrementing = true;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getFriendsAddedAttribute()
    {
        $ids = Friend::where(function ($query) {
            $query->where('user_id', $this->id)
                ->orWhere('to_id', $this->id);
        })->where('status', 'accepted')->get();

        $filtered = $ids->map(function ($friend) {
            if ($friend->user_id !== auth()->user()->id) {
                return $friend->user_id;
            } else {
                return $friend->to_id;
            }
        });
        return User::whereIn('id', $filtered)->get();
    }

    public function getRequestsReceivedAttribute()
    {
        $ids = Friend::where('to_id', $this->id)
            ->where('status', 'pending')->get();
        
        $filtered = $ids->map(function ($friend) {
            return $friend->user_id;
        });
        return User::whereIn('id', $filtered)->get();
    }

    public function getFriendsCantAddAttribute()
    {
        $ids = Friend::where(function ($query) {
            $query->where('user_id', $this->id)
                ->orWhere('to_id', $this->id);
        })->get();

        $filtered = $ids->map(function ($friend) {
            if ($friend->user_id !== auth()->user()->id) {
                return $friend->user_id;
            } else {
                return $friend->to_id;
            }
        });
        return $filtered->unique()->values()->all();
    }
}
