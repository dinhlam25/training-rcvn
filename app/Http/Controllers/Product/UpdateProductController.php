<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UpdateProductController extends Controller
{
    public function __invoke($id,UpdateProductRequest $request)
    {
        // dd($request->all());
        $product = Product::findorFail($id);

        $data = $request->only([
            'product_name',
            'product_price',
            'is_sales',
            'description',
        ]);

        if($request->filled('product_image') && is_string($request->product_image)){

            $path = parse_url($request->product_image)['path'];
            $data['product_image'] = $path;

        } elseif($request->hasFile('product_image')){
            $data['product_image'] = Storage::put('/products', $request->product_image);
        } else {
            $data['product_image'] = null;
        }   
        
        $product->update($data);
        $product->refresh();

        return response()->json([
            'status' => 'success',
            'product' => $product,
            'message' => 'Cập nhật thành công product id: '.$product->id
        ], 201);
    }
}
