<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenaltySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('penalties')->insert([
    [
        'rental_id' => 1,
        'damage_description' => 'Late return of equipment',
        'penalty_fee' => 50000,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'rental_id' => 2,
        'damage_description' => 'Tent zipper broken',
        'penalty_fee' => 100000,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'rental_id' => 3,
        'damage_description' => 'Mat torn',
        'penalty_fee' => 30000,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'rental_id' => 4,
        'damage_description' => 'Portable stove scratched',
        'penalty_fee' => 25000,
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'rental_id' => 5,
        'damage_description' => 'Carrier wet and dirty',
        'penalty_fee' => 40000,
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);
    }
}
