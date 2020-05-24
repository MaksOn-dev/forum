<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    public function test_unathanticated_users_may_not_add_replies()
    {
        $thread = create('App\Thread');
        $reply = make('App\Reply');

        $this->post($thread->path('replies'), $reply->toArray())
            ->assertRedirect('/login');
    }

    /**
     * A basic feature test example.
     */
    public function test_authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply');

        $this->post($thread->path('replies'), $reply->toArray())
            ->assertStatus(302);
        
        // Then their reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
