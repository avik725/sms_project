<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category' => 'Food Staples'],
            ['category' => 'Oils & Dairy'],
            ['category' => 'Snacks & Beverages'],
            ['category' => 'Breakfast Essentials'],
            ['category' => 'Dry Fruits & Health'],
            ['category' => 'Personal Care'],
            ['category' => 'Home Care'],
            ['category' => 'Packaged Foods'],
            ['category' => 'Hygiene & Wellness'],
        ];

        DB::table('categories')->insert($categories);
    }
}
