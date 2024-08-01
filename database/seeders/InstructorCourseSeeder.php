<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InstructorCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Assuming there are already courses in the 'courses' table
        $courseIds = DB::table('courses')->pluck('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            $coursesToAssign = $faker->numberBetween(1, 2);
            $assignedCourses = $faker->randomElements($courseIds, $coursesToAssign);

            foreach ($assignedCourses as $courseId) {
                DB::table('instructor_courses')->insert([
                    'instructor_id' => $i,
                    'course_id' => $courseId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
