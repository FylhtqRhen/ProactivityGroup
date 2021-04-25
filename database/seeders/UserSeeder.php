<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => env('USER_LOGIN'),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make(env('USER_PASSWORD')),
            'token' => Str::random(32)
        ]);
    }
}
