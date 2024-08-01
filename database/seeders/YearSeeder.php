<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = [
            [
            'name' => 'Tahun Ajaran 2024 - 2025',
            'start_date' => '2024-01-01',
            'end_date' => '2024-7-31',
            'status' => 'active',
            'is_published' => true,
            ],
            [
            'name' => 'Tahun Ajaran 2025 - 2026',
            'start_date' => '2024-08-01',
            'end_date' => '2024-12-31',
            'status' => 'active',
            'is_published' => true,
            ],
        ];
        foreach ($years as $year) {
            Year::create($year);
        }
    }
}
