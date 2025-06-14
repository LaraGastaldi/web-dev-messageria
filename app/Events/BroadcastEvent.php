<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BroadcastEvent implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public function __construct(public $message, public $on, public $from)
  {
    //
  }

  public function broadcastOn()
  {
    return ['chat.' . $this->on];
  }

  public function broadcastAs()
  {
      return 'message';
  }
}