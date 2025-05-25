<?php

namespace App\Livewire\Forms;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AddFriend extends Component
{
    public $username;
    public $found = [];
    public function addFriend()
    {
        $this->validate([
            'username' => ['required', 'string', 'max:255'],
        ]);
        $username = $this->username;
        $friend = User::where('username', $username)->first();
        if (!$friend) {
            throw ValidationException::withMessages([
                'form.add-friend' => __('validation.user_not_found'),
            ]);
        }
        $friendship = Friend::where('user_id', auth()->user()->id)
            ->where('to_id', $friend->id)
            ->orWhere('user_id', $friend->id)
            ->first();
        if ($friendship) {
            if ($friendship->status == 'pending') {
                throw ValidationException::withMessages([
                    'form.add-friend' => __('validation.friend_request_pending'),
                ]);
            } elseif ($friendship->status == 'accepted') {
                throw ValidationException::withMessages([
                    'form.add-friend' => __('validation.already_friends'),
                ]);
            }
            elseif ($friendship->status == 'blocked') {
                throw ValidationException::withMessages([
                    'form.add-friend' => __('validation.friend_request_blocked'),
                ]);
            }
        }
        $friendship = new Friend();
        $friendship->user_id = auth()->user()->id;
        $friendship->to_id = $friend->id;
        $friendship->status = 'pending';
        $friendship->save();
        $this->dispatch('friendAdded', [
            'type' => 'success',
            'message' => __('validations.friend_request_sent'),
        ]);
        $this->username = '';
    }

    public function searchFriend()
    {
        $username = $this->username;
        if (strlen($username) < 3) {
            $this->found = [];
            $this->dispatch('friendEmpty', [
                'type' => 'error',
                'message' => __('validation.min.string', ['attribute' => 'username', 'min' => 3]),
            ]);
            return;
        }
        $friends = User::where('username', 'LIKE', "%$username%")
            ->where('id', '!=', auth()->user()->id)
            ->whereNotIn('id', auth()->user()->friendsCantAdd);

        $this->found = $friends->get();
        if ($this->found->isNotEmpty()) {
            $this->dispatch('friendFound', [
                'type' => 'success'
            ]);
        }
    }

    public function sendFriendRequest($friendId)
    {
        $friend = User::find($friendId);
        if (!$friend) {
            throw ValidationException::withMessages([
                'form.add-friend' => __('validation.user_not_found'),
            ]);
        }
        $friendship = Friend::where('user_id', auth()->user()->id)
            ->where('to_id', $friend->id)
            ->orWhere('user_id', $friend->id)
            ->first();
        if ($friendship) {
            if ($friendship->status == 'pending') {
                throw ValidationException::withMessages([
                    'form.add-friend' => __('validation.friend_request_pending'),
                ]);
            } elseif ($friendship->status == 'accepted') {
                throw ValidationException::withMessages([
                    'form.add-friend' => __('validation.already_friends'),
                ]);
            }
            elseif ($friendship->status == 'blocked') {
                throw ValidationException::withMessages([
                    'form.add-friend' => __('validation.friend_request_blocked'),
                ]);
            }
        }
        $friendship = new Friend();
        $friendship->user_id = auth()->user()->id;
        $friendship->to_id = $friend->id;
        $friendship->status = 'pending';
        $friendship->save();
        $this->dispatch('friendAdded', [
            'type' => 'success',
            'message' => __('validations.friend_request_sent'),
        ]);
        $this->username = '';
        $this->found = [];
        $this->dispatch('friendEmpty', [
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.forms.add-friend');
    }
}
