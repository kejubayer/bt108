<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=> Hash::make("12345"),
            'phone'=> '01710000000',
            'address'=> 'Dhaka, Bangladesh',
            'role'=> 'admin',
        ]);
        User::create([
            'name'=>'Customer',
            'email'=>'customer@gmail.com',
            'password'=> Hash::make("12345"),
            'phone'=> '01710000000',
            'address'=> 'Dhaka, Bangladesh',
            'role'=> 'customer',
        ]);
    }
}
