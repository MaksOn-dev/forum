<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
   
    /** @test */
    public function test_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $thread = make(Thread::class);

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function test_guest_may_not_create_new_forum_threads_or_see_create_thread_page()
    {
        $thread = make(Thread::class);

        $this->post('/threads', $thread->toArray())
            ->assertRedirect('/login');

        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

    public function test_a_thread_validation_rules()
    {
        $this->signIn();

        $this->publishThreadWith(['title' => null])
            ->assertSessionHasErrors('title');
        $this->publishThreadWith(['body' => null])
            ->assertSessionHasErrors('body');
    }

    public function test_a_thread_requires_a_valid_channel()
    {
        $this->signIn();

        $channel = factory('App\Channel')->create(['id' => 1]);

        $this->publishThreadWith(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');
        
        $this->publishThreadWith(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');

        $this->publishThreadWith(['channel_id' => $channel->id])
            ->assertSessionHasNoErrors();
    }

    protected function publishThreadWith(Array $overrides)
    {
        $thread = make(Thread::class, $overrides);

        return $this->post('/threads', $thread->toArray());
    }
}
