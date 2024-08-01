<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class EducationDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $levels = ['S1', 'S2', 'S3'];

        for ($i = 1; $i <= 10; $i++) {
            foreach ($levels as $level) {
                DB::table('education_details')->insert([
                    'instructor_id' => $i,
                    'level' => $level,
                    'degree' => $faker->jobTitle,
                    'university' => $faker->company,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
