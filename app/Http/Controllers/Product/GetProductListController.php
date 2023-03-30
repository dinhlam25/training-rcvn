<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\Product\ProductResource;
use App\Http\Requests\Product\GetProductListRequest;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class GetProductListController extends Controller
{
    public function __invoke(GetProductListRequest $request)
    {
        $products = $this->filterProducts($request);
        $products = $products->paginate(10);
        
        return ProductResource::collection($products);
    }

    public function filterProducts(GetProductListRequest $request): Builder
    {
        $products = Product::latest();

        if ($request->filled('product_name')) {
            $products->where('product_name', 'like', '%'.$request->product_name.'%');
        }

        if ($request->filled('is_sales')) {
            $products->where('is_sales', $request->is_sales);
        }

        if ($request->filled('product_price_from')) {
            $products->where('product_price', '>=', $request->product_price_from);
        }

        if ($request->filled('product_price_to')) {
            $products->where('product_price', '<=', $request->product_price_to);
        }

        return $products;

    }
}
