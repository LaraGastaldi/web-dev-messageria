<?php

namespace App\Services;

use App\Events\BroadcastEvent;

class MessageService
{
    public function sendMessage($from, $to, $message)
    {
        BroadcastEvent::dispatch($message, $to, $from);
    }
}