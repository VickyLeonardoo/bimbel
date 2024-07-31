<?php

namespace Database\Seeders;

use App\Models\Child;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $childs = [
            [
                'user_id' => 2,
                'name' => 'Evelyn',
                'school' => 'Yos Sudarso',
                'bod' => '2024-01-01',
                'class' => '10',
                'photo' => 'default.png',
            ],
            [
                'user_id' => 2,
                'name' => 'Jack',
                'school' => 'Yos Sudarso',
                'bod' => '2024-01-01',
                'class' => '10',
                'photo' => 'default.png',
            ],
            [
                'user_id' => 2,
                'name' => 'John',
                'school' => 'Yos Sudarso',
                'bod' => '2024-01-01',
                'class' => '10',
            ],
            [
                'user_id' => 3,
                'name' => 'Tretan',
                'school' => 'Yos Sudarso',
                'bod' => '2024-01-01',
                'class' => '10',
            ],
            [
                'user_id' => 4,
                'name' => 'Rizki',
                'school' => 'Yos Sudarso',
                'bod' => '2024-01-01',
                'class' => '10',
            ],
            [
                'user_id' => 4,
                'name' => 'Prazz',
                'school' => 'Yos Sudarso',
                'bod' => '2024-01-01',
                'class' => '10',
            ]
        ];
        foreach ($childs as $child) {
            Child::create($child);
        }
    }
}
