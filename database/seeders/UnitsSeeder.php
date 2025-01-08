<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Predefined Units - Weight
        Unit::insert([
            ['name' => 'Kilogram', 'type' => 'Weight', 'base_unit' => 'Kilogram', 'conversion_factor' => 1],
            ['name' => 'Gram', 'type' => 'Weight', 'base_unit' => 'Kilogram', 'conversion_factor' => 0.001],
            ['name' => 'Milligram', 'type' => 'Weight', 'base_unit' => 'Kilogram', 'conversion_factor' => 0.000001],
            ['name' => 'Quintal', 'type' => 'Weight', 'base_unit' => 'Kilogram', 'conversion_factor' => 100],
            ['name' => 'Metric Ton', 'type' => 'Weight', 'base_unit' => 'Kilogram', 'conversion_factor' => 1000],
        ]);

        // Predefined Units - Volume
        Unit::insert([
            ['name' => 'Litre', 'type' => 'Volume', 'base_unit' => 'Litre', 'conversion_factor' => 1],
            ['name' => 'Millilitre', 'type' => 'Volume', 'base_unit' => 'Litre', 'conversion_factor' => 0.001],
            ['name' => 'Gallon (US)', 'type' => 'Volume', 'base_unit' => 'Litre', 'conversion_factor' => 3.785],
            ['name' => 'Pint (US)', 'type' => 'Volume', 'base_unit' => 'Litre', 'conversion_factor' => 0.473],
        ]);

        // Predefined Units - Count
        Unit::insert([
            ['name' => 'Piece', 'type' => 'Count', 'base_unit' => null, 'conversion_factor' => null],
            ['name' => 'Packet', 'type' => 'Count', 'base_unit' => null, 'conversion_factor' => null],
            ['name' => 'Carton', 'type' => 'Count', 'base_unit' => null, 'conversion_factor' => null],
            ['name' => 'Dozen', 'type' => 'Count', 'base_unit' => null, 'conversion_factor' => 12],
        ]);

        // User-Defined Units
        Unit::insert([
            ['name' => 'Bag', 'type' => 'Weight', 'base_unit' => null, 'conversion_factor' => null],
            ['name' => 'Tray', 'type' => 'Count', 'base_unit' => null, 'conversion_factor' => null],
            ['name' => 'Box', 'type' => 'Count', 'base_unit' => null, 'conversion_factor' => null],
        ]);
    }
}
