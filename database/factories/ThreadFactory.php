<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use App\User;
use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id'   => function(){
            $users = User::all();
            if(random_int(0, 10) > 8 || $users->count() == 0){
                return factory('App\User')->create()->id;
            }else{
                return $users->random()->id;
            }
        },
        'channel_id'=> function(){
            $channel = Channel::all();
            if(random_int(0, 20) > 17 || $channel->count() == 0){
                return factory('App\Channel')->create()->id;
            }else{
                return $channel->random()->id;
            }
        },
        'title'     => $faker->sentence,
        'body'      => $faker->text
    ];
});
