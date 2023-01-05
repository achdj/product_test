<?php

namespace Database\Seeders\Product;
use App\Models\Product\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Futuredew',
            'description' => 'A shortcut to the way your skin looks after a full skincare routine—dewy, glowing, cared-for—in one long-wearing product',
            'price' => 1712.5,
        ]);

        Product::create([
            'name' => 'Milky Jelly Cleanser',
            'description' => 'A nourishing (and pH-balanced), creamy gel face wash that’s kind to every skin type under the sun.',
            'price' => 10,
        ]);
    }
}
