<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Historic;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

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
        $product->fill($request->only(['code', 'name', 'price', 'current_quantity']));
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
     * @param UpdateProductRequest $request
     * @param \App\Models\Product $product
     * @param ProductService $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product, ProductService $service)
    {
        $data = $request->only(['code', 'name', 'price', 'current_quantity']);
        return $service->update($product, $data);
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

    public function bulk(Request $request, ProductService $service){
        $request->validate([
            'filename' => 'required',//|mimes:csv|max:2048',
        ]);

        $attachment = $request->file('filename');
        $handle = fopen($attachment, 'r');
        while (!feof($handle)) {
            $rawProductList[] = fgetcsv($handle, 0, ',');
        }
        fclose($handle);
        $productList = [];
        array_shift($rawProductList);

        foreach ($rawProductList as $rawProduct){
            if(!is_array($rawProduct)) continue;
            $data = ['code' => $rawProduct[0],'name' => $rawProduct[1], 'price' => $rawProduct[2],'current_quantity' => $rawProduct[3]];

            $product = Product::firstWhere('code', $data['code']);
            if($product == null){
                $rules  = (new CreateProductRequest())->rules();
                $validator = $this->getValidationFactory()->make($data, $rules);
                if ($validator->fails()) continue;
                $product = Product::create($data);
                $product->save();
                $productList[] = $product;
            }else{
                $rules  = (new CreateProductRequest())->rules();
                $rules['code'] = 'required';
                $validator = $this->getValidationFactory()->make($data, $rules);
                if ($validator->fails()) continue;
                $productList[] = $service->update($product, $data);
            }
        }
        return response()
            ->json($productList)
            ->setStatusCode(201);
    }
}
