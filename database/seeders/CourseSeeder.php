<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
            'name' => 'Pemrograman Web', 
            'description' => 'Belajar tentang dasar-dasar pemrograman web, termasuk HTML, CSS, dan JavaScript.', 
            'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.freepik.com%2Ffree-vector%2Fweb-development-concept-illustration_10636567.htm&psig=AOvVaw3_369y8124_12448363&ust=1701146052810000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCJj7j426_4wCFQAAAAAdAAAAABAE', 
            'code' => 'PW', 
            'price' => 1000000,
            'slug' => 'pemrograman-web',
            'sesi' => 16,
            ],
            [
            'name' => 'Desain Grafis', 
            'description' => 'Belajar tentang desain grafis, termasuk Photoshop, Illustrator, dan Corel Draw.', 
            'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.freepik.com%2Ffree-vector%2Fgraphic-design-concept-illustration_10636566.htm&psig=AOvVaw3_369y8124_12448363&ust=1701146052810000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCJj7j426_4wCFQAAAAAdAAAAABAI', 
            'code' => 'DF', 
            'price' => 800000,
            'slug' => 'desain-grafis',
            'sesi' => 16,
            ],
        ];
        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
