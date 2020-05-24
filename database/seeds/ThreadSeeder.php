<?php

use App\Thread;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create threads. It will automatically create users, replies and channels
        factory(Thread::class, 50)->create();
    }
}
