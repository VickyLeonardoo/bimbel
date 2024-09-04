<?php

namespace Database\Seeders;

use App\Models\Child;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $totalChildren = 20;
        $userIds = [2, 3, 4];

        for ($i = 0; $i < $totalChildren; $i++) {
            Child::create([
                'user_id' => $faker->randomElement($userIds),
                'name' => $faker->firstName,
                'school' => 'Yos Sudarso',
                'bod' => $faker->date('Y-m-d', '2024-01-01'),
                'class' => '10',
                'photo' => 'default.png',
            ]);
        }
    }
}
