<?php

namespace App\Http\Controllers\View;

class MessagesController
{
    public function index()
    {
        return view('pages.messages', [
            'channel' => auth()->user()->id,
            'friends' => auth()->user()->friendsAdded,
            'requests' => auth()->user()->friendRequests ?? collect([]),
        ]);
    }
}