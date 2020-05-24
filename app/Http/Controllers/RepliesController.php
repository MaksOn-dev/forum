<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store($channel_id, Thread $thread)
    {
        $thread->addReply([
            'body'      => request('body'),
            'user_id'   => auth()->user()->id
        ]);

        return back();
    }
}
