<?php

namespace Database\Seeders\Product;
use App\Models\Product\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductVariant::create([
            'name' => 'Boy Brow + Balm Dotcom + Futuredew',
            'price' => 404,
            'product_id' => 1,
        ]);

        ProductVariant::create([
            'name' => 'The 3-Step Skincare Routine',
            'price' => 44,
            'product_id' => 2,
        ]);
    }
}
