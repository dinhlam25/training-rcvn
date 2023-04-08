<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class GetOneProductController extends Controller
{
    public function __invoke($id,Request $request)
    {
        // dd($request->user('api'));
        dd('user request',$request->user('api'));

        $product = Product::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'product'=> $product
        ]);
    }
}
