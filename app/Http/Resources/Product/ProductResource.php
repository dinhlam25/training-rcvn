<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'product_image' => $this->product_image,
            'product_price' => $this->product_price,
            'description' => $this->description,
            'is_sales' => $this->is_sales === -1 ? 'Ngừng bán' :  ($this->is_sales === 0 ? 'Hết hàng' : 'Đang bán') ,
        ];
    }
}
