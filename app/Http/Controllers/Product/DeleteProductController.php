<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class DeleteProductController extends Controller
{
    public function __invoke($id,DeleteProductRequest $request)
    {
        // if($id === $request->user('api')){
        //     response()->json([
        //         'status' => 'failed',
        //         'message' => 'Bạn không thể tự xóa mình',
        //     ]);
        // }
        die($request->user('api'));
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Xóa ID: '.$id.' thành công',
        ]);
    }
}
