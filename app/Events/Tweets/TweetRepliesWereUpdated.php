<?php

namespace App\Events\Tweets;

use App\Tweet;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TweetRepliesWereUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $tweet;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->tweet->id,
            'count' => $this->tweet->replies->count()
        ];
    }

    public function broadcastAs()
    {
        return 'TweetRepliesWereUpdated';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('tweets');
    }
}