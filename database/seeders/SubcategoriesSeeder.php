<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            // Food Staples
            ['category_id' => 1, 'subcategory' => 'Atta & Rice'],
            ['category_id' => 1, 'subcategory' => 'Dal & Pulses'],
            ['category_id' => 1, 'subcategory' => 'Masala & Spices'],
            ['category_id' => 1, 'subcategory' => 'Salt & Sugar'],
            // Oils & Dairy
            ['category_id' => 2, 'subcategory' => 'Oil & Ghee'],
            ['category_id' => 2, 'subcategory' => 'Dairy'],
            ['category_id' => 2, 'subcategory' => 'Bakery & Eggs'],
            // Snacks & Beverages
            ['category_id' => 3, 'subcategory' => 'Biscuits'],
            ['category_id' => 3, 'subcategory' => 'Chips & Namkeens'],
            ['category_id' => 3, 'subcategory' => 'Chocolates & Sweets'],
            ['category_id' => 3, 'subcategory' => 'Beverages'],
            // Breakfast Essentials
            ['category_id' => 4, 'subcategory' => 'Breakfast Essentials'],
            ['category_id' => 4, 'subcategory' => 'Noodles, Pasta & Sauces'],
            // Dry Fruits & Health
            ['category_id' => 5, 'subcategory' => 'Dry Fruits'],
            ['category_id' => 5, 'subcategory' => 'Nuts & Seeds'],
            ['category_id' => 5, 'subcategory' => 'Health Supplements'],
            // Hygiene & Wellness
            ['category_id' => 9, 'subcategory' => 'Hygiene'],
            ['category_id' => 9, 'subcategory' => 'Wellness'],
            // Personal Care
            ['category_id' => 6, 'subcategory' => 'Skin Care'],
            ['category_id' => 6, 'subcategory' => 'Hair Care'],
            // Home Care
            ['category_id' => 7, 'subcategory' => 'Cleaning Essentials'],
            ['category_id' => 7, 'subcategory' => 'Laundry Essentials'],
            // Packaged Foods
            ['category_id' => 8, 'subcategory' => 'Ready-to-Eat Meals'],
            ['category_id' => 8, 'subcategory' => 'Canned & Packaged'],
        ];

        DB::table('subcategories')->insert($subcategories);
    }
}
