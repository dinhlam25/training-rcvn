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

        if ($request->filled('productName')) {
            $products->where('product_name', 'like', '%'.$request->productName.'%');
        }

        if ($request->filled('isSales')) {
            $products->where('is_sales', $request->isSales);
        }

        if ($request->filled('productPriceFrom')) {
            $products->where('product_price', '>=', $request->productPriceFrom);
        }

        if ($request->filled('productPriceTo')) {
            $products->where('product_price', '<=', $request->productPriceTo);
        }

        return $products;

    }
}
