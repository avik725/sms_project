<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItemsModel;  // Import the ItemsModel

class ItemsSeeder extends Seeder
{
    public function run()
    {
        $items = [
            ['Ashirvaad Atta (10kg)', 1, 1, 'Weight', 1, 10.00, 300.00, 350.00],
            ['Fortune Basmati Rice (5kg)', 1, 1, 'Weight', 1, 5.00, 400.00, 450.00],
            ['Tata Salt (1kg)', 1, 4, 'Weight', 1, 1.00, 20.00, 25.00],
            ['Amul Butter (500g)', 2, 6, 'Weight', 1, 0.50, 150.00, 180.00],
            ['Britannia Milk (1L)', 2, 6, 'Volume', 6, 1.00, 50.00, 60.00],
            ['Britannia Rusk (400g)', 2, 6, 'Weight', 1, 0.40, 100.00, 120.00],
            ['Haldiram\'s Soan Papdi (500g)', 3, 10, 'Weight', 1, 0.50, 200.00, 250.00],
            ['Lay\'s Classic Chips (100g)', 3, 9, 'Weight', 1, 0.10, 30.00, 40.00],
            ['Maggi Instant Noodles (70g)', 4, 13, 'Weight', 1, 0.07, 15.00, 20.00],
            ['Britannia Good Day Biscuits (200g)', 3, 8, 'Weight', 1, 0.20, 50.00, 60.00],
            ['Aashirvaad Atta (5kg)', 1, 1, 'Weight', 1, 5.00, 150.00, 180.00],
            ['Fortune Soya Chunks (1kg)', 1, 2, 'Weight', 1, 1.00, 90.00, 110.00],
            ['Parle-G Biscuits (200g)', 3, 8, 'Weight', 1, 0.20, 35.00, 45.00],
            ['MTR Rava (1kg)', 1, 2, 'Weight', 1, 1.00, 80.00, 100.00],
            ['Tata Tea Gold (500g)', 3, 9, 'Weight', 1, 0.50, 250.00, 300.00],
            ['Vim Dishwash Bar (250g)', 6, 19, 'Weight', 1, 0.25, 30.00, 40.00],
            ['Nescafe Coffee (100g)', 3, 9, 'Weight', 1, 0.10, 150.00, 180.00],
            ['Patanjali Dant Kanti Toothpaste (200g)', 7, 24, 'Weight', 1, 0.20, 50.00, 60.00],
            ['Gokul Tond (500g)', 6, 20, 'Weight', 1, 0.50, 120.00, 150.00],
            ['Colgate Max Fresh Toothpaste (200g)', 7, 24, 'Weight', 1, 0.20, 50.00, 60.00],
            ['Tata Agni (200g)', 3, 8, 'Weight', 1, 0.20, 40.00, 50.00],
            ['Britannia Treat (200g)', 3, 8, 'Weight', 1, 0.20, 60.00, 75.00],
            ['Maggi Atta Noodles (200g)', 4, 13, 'Weight', 1, 0.20, 25.00, 30.00],
            ['Top Ramen (100g)', 4, 13, 'Weight', 1, 0.10, 10.00, 15.00],
            ['Amul Cheese (200g)', 2, 6, 'Weight', 1, 0.20, 120.00, 150.00],
            ['Nestle Milkmaid (400g)', 2, 6, 'Weight', 1, 0.40, 180.00, 220.00],
            ['Kissan Tomato Ketchup (500g)', 3, 9, 'Weight', 1, 0.50, 60.00, 75.00],
            ['Tata Coffee (200g)', 3, 9, 'Weight', 1, 0.20, 120.00, 150.00],
            ['Dove Soap (125g)', 7, 23, 'Weight', 1, 0.125, 35.00, 45.00],
            ['BoroPlus Cream (100g)', 7, 23, 'Weight', 1, 0.10, 60.00, 75.00],
            ['Sunsilk Shampoo (200ml)', 7, 21, 'Volume', 6, 0.20, 60.00, 75.00],
            ['Pantene Shampoo (200ml)', 7, 21, 'Volume', 6, 0.20, 80.00, 100.00],
            ['Ariel Detergent Powder (1kg)', 6, 19, 'Weight', 1, 1.00, 150.00, 180.00],
            ['Pampers Diapers (30pcs)', 8, 25, 'Count', 10, 30.00, 450.00],
            ['Pedigree Dog Food (1kg)', 8, 26, 'Weight', 1, 1.00, 200.00, 250.00],
            ['Coca Cola (1L)', 3, 11, 'Volume', 6, 1.00, 40.00, 50.00],
            ['Pepsi (1L)', 3, 11, 'Volume', 6, 1.00, 40.00, 50.00],
            ['Fanta (1L)', 3, 11, 'Volume', 6, 1.00, 40.00, 50.00],
            ['Kissan Mixed Fruit Jam (500g)', 3, 9, 'Weight', 1, 0.50, 90.00, 110.00],
            ['Shakti Bhog Atta (5kg)', 1, 1, 'Weight', 1, 5.00, 150.00, 180.00],
            ['MTR Sambar Powder (100g)', 1, 3, 'Weight', 1, 0.10, 50.00, 60.00],
            ['Tata Sampann Dal (1kg)', 1, 2, 'Weight', 1, 1.00, 80.00, 100.00],
            ['Haldiram\'s Bhujia (200g)', 3, 9, 'Weight', 1, 0.20, 70.00, 90.00],
            ['Kellogg\'s Cornflakes (500g)', 3, 9, 'Weight', 1, 0.50, 150.00, 180.00],
            ['Pillsbury Maida (1kg)', 1, 1, 'Weight', 1, 1.00, 45.00, 55.00],
            ['Tata Coffee (500g)', 3, 9, 'Weight', 1, 0.50, 250.00, 300.00],
            ['Britannia Milk (200ml)', 2, 6, 'Volume', 6, 0.20, 20.00, 25.00],
            ['Yippee Noodles (70g)', 4, 13, 'Weight', 1, 0.07, 12.00, 15.00],
            ['Lipton Tea (200g)', 3, 9, 'Weight', 1, 0.20, 120.00, 150.00],
            ['Britannia NutriChoice (200g)', 3, 8, 'Weight', 1, 0.20, 80.00, 100.00],
            ['Rin Detergent Powder (500g)', 6, 19, 'Weight', 1, 0.50, 60.00, 75.00],
            ['Tata Salt (500g)', 1, 4, 'Weight', 1, 0.50, 10.00, 15.00],
            ['Patanjali Honey (500g)', 3, 9, 'Weight', 1, 0.50, 120.00, 150.00],
            ['Sundrop Refined Oil (1L)', 2, 5, 'Volume', 6, 1.00, 120.00, 150.00],
            ['Kissan Tomato Ketchup (1L)', 3, 9, 'Volume', 6, 1.00, 80.00, 100.00],
            ['Pears Soap (125g)', 7, 23, 'Weight', 1, 0.125, 30.00, 40.00],
        ];

        foreach ($items as $item) {
            // Check if any item has missing selling price
            if (!isset($item[7])) {
                $item[7] = $item[6]; // Default selling price to buying price if not provided
            }

            // Insert the item using the ItemsModel
            ItemsModel::create([
                'item' => $item[0],
                'category_id' => $item[1],
                'subcategory_id' => $item[2],
                'measurement_category' => $item[3],
                'units_id' => $item[4],
                'measurement_value' => $item[5],
                'buying_price' => $item[6],
                'selling_price' => $item[7],
            ]);
        }
    }
}
