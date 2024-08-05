<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $dateNext = $now->copy()->addDays(10); // Menggunakan copy() agar $now tidak berubah
        $dateBefore = $now->copy()->subDays(10); // Menggunakan copy() agar $now tidak berubah

        $discount = [
            [
                'name' => 'Diskon Ajaran Baru',
                'code' => 'diskon21',
                'total' => 20,
                'type' => 'percent',
                'status' => false,
                'date_valid' => $dateNext,
            ],
            [
                'name' => 'Diskon Ajaran Baru',
                'code' => 'diskon22',
                'total' => 200000,
                'type' => 'value',
                'status' => true,
                'date_valid' => $dateNext,
            ],
            [
                'name' => 'Diskon Ajaran Baru',
                'code' => 'diskon23',
                'total' => 200000,
                'type' => 'value',
                'status' => true,
                'date_valid' => $dateBefore,
            ]
        ];

        DB::table('discounts')->insert($discount);
    }
}
