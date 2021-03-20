<?php

namespace Database\Seeders;

use App\Models\Historic;
use App\Models\Product;
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
        Product::factory()
            ->count(100)
            ->create();
        Product::all()->each(function ($product){
           Historic::factory()->count(rand(3,7))->create(['product_id' => $product->id]);
        });
    }
}
