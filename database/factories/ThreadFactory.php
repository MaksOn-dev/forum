<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id'   => function(){
            $users = User::all();
            if(random_int(0, 10) > 7 || $users->count() == 0){
                return factory('App\User')->create()->id;
            }else{
                return $users->random()->id;
            }
        },
        'title'     => $faker->sentence,
        'body'      => $faker->text
    ];
});
