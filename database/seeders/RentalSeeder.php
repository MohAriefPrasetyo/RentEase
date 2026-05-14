<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('rentals')->insert([
    [
        'user_id' => 1, // Merujuk ke user yang dibuat di DatabaseSeeder
        'equipment_id' => 1,
        'rental_date' => '2026-05-13',
        'return_date' => '2026-05-15',
        'guarantee' => 'ID Card',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'user_id' => 1,
        'equipment_id' => 2,
        'rental_date' => '2026-05-16',
        'return_date' => '2026-05-18',
        'guarantee' => 'Driver License',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'user_id' => 1,
        'equipment_id' => 3,
        'rental_date' => '2026-05-20',
        'return_date' => '2026-05-22',
        'guarantee' => 'Student Card',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'user_id' => 1,
        'equipment_id' => 4,
        'rental_date' => '2026-05-23',
        'return_date' => '2026-05-25',
        'guarantee' => 'ID Card',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'user_id' => 1,
        'equipment_id' => 5,
        'rental_date' => '2026-05-27',
        'return_date' => '2026-05-29',
        'guarantee' => 'Driver License',
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);
    }
}
