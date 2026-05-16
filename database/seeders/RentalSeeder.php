<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        $rentals = [
            ['user_id' => 1, 'renter_name' => 'Budi Santoso',  'rental_date' => '2026-05-13', 'return_date' => '2026-05-15', 'guarantee' => 'KTP',              'total_price' => 0],
            ['user_id' => 1, 'renter_name' => 'Siti Rahayu',   'rental_date' => '2026-05-16', 'return_date' => '2026-05-18', 'guarantee' => 'SIM',              'total_price' => 0],
            ['user_id' => 1, 'renter_name' => 'Andi Wijaya',   'rental_date' => '2026-05-20', 'return_date' => '2026-05-22', 'guarantee' => 'Kartu Mahasiswa',  'total_price' => 0],
        ];

        foreach ($rentals as $rental) {
            DB::table('rentals')->insert(array_merge($rental, ['created_at' => now(), 'updated_at' => now()]));
        }
    }
}
