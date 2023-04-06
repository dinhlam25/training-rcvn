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
        
        // \Log::info(print_r($request->all(), true));


        $product = Product::findOrFail($id);

        $data = $request->only([
            'product_name',
            'product_price',
            'is_sales',
            'description',
        ]);

        // if($request->filled('product_image') && is_string($request->product_image)){

        //     $path = parse_url($request->product_image)['path'];
        //     $data['product_image'] = $path;

        // dd($request->all());

        if($request->hasFile('product_image')){
            $data['product_image'] = Storage::disk('local')->put('/products', $request->product_image);
            // dd($data);
            // \Log::info(print_r($data['product_image']));
        } else {
            // \Log::info('meo zo');
            $data['product_image'] = null;
        }
        
       ;
        
        $product->update($data);
        $product->refresh();

        // dd($product);

        return response()->json([
            'status' => 'success',
            'product' => $product,
            'message' => 'Cập nhật thành công product id: '.$product->id
        ], 201);
    }
}
