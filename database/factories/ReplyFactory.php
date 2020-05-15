<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Reply;
use App\Thread;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id'   => function(){
            return User::all()->random()->id;
        },
        'thread_id' => function(){
            return Thread::all()->random()->id;
        },
        'body'      => $faker->sentence
    ];
});
