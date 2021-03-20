<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Historic;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::orderByDesc('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request, Product $product)
    {
        $product->fill($request->only(['name', 'price', 'current_quantity']));
        $product->uuid = Str::uuid();
        $product->save();

        return response()
            ->json($product)
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->only(['name', 'price', 'current_quantity']);
        if ($data['current_quantity'] != $product->current_quantity){
            Historic::create([
                'product_id' => $product->id,
                'quantity' => $product->current_quantity,
                'quantity_at' => $product->updated_at,
            ]);
        }
        $product->update($data);
        $product->update();
        $product->save();

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }

    public function historicByProduct(Request $request, $id){
        return Historic::where('product_id', $id)->orderByDesc('quantity_at')->get();
    }
}
