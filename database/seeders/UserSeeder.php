<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'phone' => '081275521111',
                'email' => 'admin@example.com',
                'password' => bcrypt('123'),
                'is_verified' => true,
                'is_active' => true,
                'role' => '1',
            ],
            [
                'name' => 'User 1',
                'phone' => '081275521222',
                'email' => 'user1@example.com',
                'password' => bcrypt('123'),
                'is_verified' => true,
                'is_active' => true,
                'role' => '1',
            ],
            [
                'name' => 'User 2',
                'phone' => '081275521333',
                'email' => 'user2@example.com',
                'password' => bcrypt('123'),
                'is_verified' => true,
                'is_active' => true,
                'role' => '1',
            ],
            [
                'name' => 'User 3',
                'phone' => '081275521444',
                'email' => 'user3@example.com',
                'password' => bcrypt('123'),
                'is_verified' => true,
                'is_active' => true,
                'role' => '1',
            ],
            [
                'name' => 'User 4',
                'phone' => '081275521555',
                'email' => 'user4@example.com',
                'password' => bcrypt('123'),
                'is_verified' => true,
                'is_active' => true,
                'role' => '1',
            ]

        ];
        DB::table('users')->insert($users);
    }
}
