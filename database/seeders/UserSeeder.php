<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
    // Seed users with roles and passwords
    $users = [
        [
            'name' => 'Owner1',
            'email' => 'owner1@example.com',
            'roles' => '1',
            'password' => Hash::make('password1'), // Hashing the password 'password1'
        ],
        [
            'name' => 'Owner3',
            'email' => 'owner3@example.com',
            'roles' => '1',
            'password' => Hash::make('password2'), // Hashing the password 'password2'
        ],
        [
            'name' => 'User1',
            'email' => 'user1@example.com',
            'roles' => '2',
            'password' => Hash::make('password3'), // Hashing the password 'password3'
        ],
        [
            'name' => 'User2',
            'email' => 'user2@example.com',
            'roles' => '2',
            'password' => Hash::make('password4'), // Hashing the password 'password4'
        ],
        // Add more users as needed
    ];

    foreach ($users as $user) {
        DB::table('users')->insert($user);
    }
}

}
