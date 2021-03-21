<?php


namespace App\Services;


use App\Models\Historic;
use App\Models\Product;

class ProductService
{
    public function update(Product $product, $data) {
        if ($data['current_quantity'] != $product->current_quantity){
            Historic::create([
                'product_id' => $product->id,
                'quantity' => $product->current_quantity,
                'quantity_at' => $product->updated_at,
            ]);
        }
        $product->update($data);
        $product->save();
        return $product;
    }
}
