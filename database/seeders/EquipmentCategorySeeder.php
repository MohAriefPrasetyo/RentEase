<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    DB::table('equipment_categories')->insert([
    ['category_name' => 'Tenda'],
    ['category_name' => 'Carrier'],
    ['category_name' => 'Sleeping Bag'],
    ['category_name' => 'Alat Masak'],
    ['category_name' => 'Matras'],
    ]);
    }
}
