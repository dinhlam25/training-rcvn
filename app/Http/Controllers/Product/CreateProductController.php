<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CreateProductController extends Controller
{
    public function __invoke(CreateProductRequest $request)
    {
        $data = $request->only([
            'product_name',
            'product_price',
            'is_sales',
            'description',
        ]);

        if($request->hasFile('product_image')){
            $data['product_image'] = Storage::put('/product',$request->product_image);
        }
        $product = Product::create($data);

        return response()->json([
            'status' => 'success',
            'product' => $product,
            'created' => true
        ], 201);
    }
}
