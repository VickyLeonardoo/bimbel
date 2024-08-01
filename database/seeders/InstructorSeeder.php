<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('instructors')->insert([
                'name' => $faker->name,
                'address' => $faker->address,
                'gender' => $faker->randomElement(['m', 'f']),
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'slug' => Str::slug($faker->name),
                'image' => $faker->imageUrl($width = 640, $height = 480),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
