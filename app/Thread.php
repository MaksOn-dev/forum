<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    public function path($additional = '')
    {
        $path = $additional ? "/threads/{$this->channel->slug}/{$this->id}/{$additional}"
            : "/threads/{$this->channel->slug}/{$this->id}";
        return $path;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }
}
