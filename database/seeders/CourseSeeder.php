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
                'name' => 'Matematika', 
                'description' => 'Belajar tentang matematika dasar, termasuk trigonometri dan geometri.', 
                'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.freepik.com%2Ffree-vector%2Fweb-development-concept-illustration_10636567.htm&psig=AOvVaw3_369y8124_12448363&ust=1701146052810000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCJj7j426_4wCFQAAAAAdAAAAABAE', 
                'code' => 'MTK', 
                'price' => 1000000,
                'slug' => 'matematika',
                'session' => 48,
            ],
            [
                'name' => 'Bahasa Inggris',
                'description' => 'Belajar tentang bahasa inggris dasar, termasuk penggunaan kata dasar dan struktur kalimat.',
                'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.freepik.com%2Ffree-vector%2Fweb-development-concept-illustration_10636567.htm&psig=AOvVaw3_369y8124_12448363&ust=1701146052810000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCJj7j426_4wCFQAAAAAdAAAAABAE', 
                'code' => 'BING',
                'price' => 1000000,
                'slug' => 'bahasa-inggris',
                'session' => 48,
                
            ],
            [
                'name' => 'Bahasa Indonesia',
                'description' => 'Belajar tentang bahasa indonesia dasar, termasuk penggunaan kata dasar dan struktur kalimat.',
                'image' => 'https://www.google',
                'code' => 'BIND',
                'price' => 1000000,
                'slug' => 'bahasa-indonesia',
                'session' => 48,
            ],
            [
                'name' => 'Fisika',
                'description' => 'Belajar tentang fisika dasar, termasuk gravitasi dan energi.',
                'image' => 'https://www.google.com/url?sa',
                'code' => 'FIS',
                'price' => 1000000,
                'slug' => 'fisika',
                'session' => 48,
            ],
            [
                'name' => 'Bahasa Korea',
                'description' => 'Belajar tentang bahasa korea dasar, termasuk penggunaan kata dasar dan struktur kalimat.',
                'image' => 'https://www.google.com/url?sa',
                'code' => 'KOR',
                'price' => 1000000,
                'slug' => 'bahasa-korea',
                'session' => 48,
            ]
        ];
        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
