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
                'equipment_category_id' => 1,
                'equipment_name' => 'Tenda Consina Magnum 2P',
                'rental_price_per_day' => 60000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 1,
                'equipment_name' => 'Tenda Rei Adventure 6P',
                'rental_price_per_day' => 95000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 1,
                'equipment_name' => 'Tenda Arei Dome 3P',
                'rental_price_per_day' => 70000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 1,
                'equipment_name' => 'Tenda Naturehike Cloud Up',
                'rental_price_per_day' => 85000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 2,
                'equipment_name' => 'Carrier Eiger 60L',
                'rental_price_per_day' => 50000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 2,
                'equipment_name' => 'Carrier Consina Alpina 55L',
                'rental_price_per_day' => 45000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 2,
                'equipment_name' => 'Carrier Rei 70L',
                'rental_price_per_day' => 55000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 2,
                'equipment_name' => 'Carrier Avtech Mountain 45L',
                'rental_price_per_day' => 40000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 2,
                'equipment_name' => 'Carrier Deuter Aircontact 65L',
                'rental_price_per_day' => 65000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 3,
                'equipment_name' => 'Sleeping Bag Eiger Polar',
                'rental_price_per_day' => 30000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 3,
                'equipment_name' => 'Sleeping Bag Consina Extreme',
                'rental_price_per_day' => 35000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 3,
                'equipment_name' => 'Sleeping Bag Rei Comfort',
                'rental_price_per_day' => 28000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 3,
                'equipment_name' => 'Sleeping Bag Naturehike Ultralight',
                'rental_price_per_day' => 40000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 3,
                'equipment_name' => 'Sleeping Bag Arei WarmPro',
                'rental_price_per_day' => 32000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 4,
                'equipment_name' => 'Kompor Portable Windproof',
                'rental_price_per_day' => 25000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 4,
                'equipment_name' => 'Nesting Cook Set 3P',
                'rental_price_per_day' => 20000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 4,
                'equipment_name' => 'Gas Portable Butane',
                'rental_price_per_day' => 15000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 4,
                'equipment_name' => 'Mini Grill Camping',
                'rental_price_per_day' => 30000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 4,
                'equipment_name' => 'Kettle Camping Stainless',
                'rental_price_per_day' => 18000,
                'availability_status' => 'available',
            ],

            // ==================== MATRAS ====================
            [
                'equipment_category_id' => 5,
                'equipment_name' => 'Matras Foam Camping',
                'rental_price_per_day' => 15000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 5,
                'equipment_name' => 'Matras Lipat Eiger',
                'rental_price_per_day' => 20000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 5,
                'equipment_name' => 'Matras Naturehike Ultralight',
                'rental_price_per_day' => 25000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 5,
                'equipment_name' => 'Matras Aluminium Foil',
                'rental_price_per_day' => 12000,
                'availability_status' => 'available',
            ],
            [
                'equipment_category_id' => 5,
                'equipment_name' => 'Matras Angin Portable',
                'rental_price_per_day' => 30000,
                'availability_status' => 'available',
            ],
        ]);
     }
}
