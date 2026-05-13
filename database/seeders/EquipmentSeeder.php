<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
DB::table('equipments')->insert([
    [
        'equipment_category_id' => 1,
        'equipment_name' => 'Tenda Eiger 4P',
        'rental_price_per_day' => 75000,
        'availability_status' => 'available',
    ],
    [
        'equipment_category_id' => 2,
        'equipment_name' => 'Carrier Consina 60L',
        'rental_price_per_day' => 50000,
        'availability_status' => 'available',
    ],
    [
        'equipment_category_id' => 3,
        'equipment_name' => 'Sleeping Bag Naturehike',
        'rental_price_per_day' => 35000,
        'availability_status' => 'available',
    ],
    [
        'equipment_category_id' => 4,
        'equipment_name' => 'Kompor Portable',
        'rental_price_per_day' => 30000,
        'availability_status' => 'available',
    ],
    [
        'equipment_category_id' => 5,
        'equipment_name' => 'Matras Camping',
        'rental_price_per_day' => 20000,
        'availability_status' => 'available',
    ],
]);
    }
}
