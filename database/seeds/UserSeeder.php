<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create main user
        if(!User::where('email', 'm@m.m')->first()){
            User::firstOrCreate([
                'name'      => 'Maks',
                'email'     => 'm@m.m',
                'password'  => Hash::make('12345678')
            ]);
        }
    }
}
