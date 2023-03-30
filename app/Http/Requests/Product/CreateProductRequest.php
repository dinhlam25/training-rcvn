<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id'    => ['min:6','unique'],
            'product_name'  => ['required','min:6'],
            'product_price' => ['required','min:0','numeric'],
            'is_sales'      => ['required'],
            'product_image' => [
                'nullable',
                'file',
                'max:2048',
                'dimensions:max_width:1024',
                'mines:png,jpg,jpeg' 
            ]
        ];
    }
    public function messages(): array
    {
        return [
            'product_name.name' => 'Vui lòng nhập tên sản phẩm.',
            'product_name.min' => 'Tên phải lớn hơn 6 ký tự.',
            'product_price.required' => 'Giá bán không được để trống.',
            'product_price.numeric' => 'Giá bán chỉ được nhập số.',
            'product_price.min' => 'Giá bán không được nhỏ hơn 0.',
            'is_sales.required' => 'Trạng thái không được để trống.',
            'product_image.mimes' => 'Chỉ cho upload các file hình png, jpg, jpeg.',
            'product_image.max' => 'Dung lượng hình không quá 2Mb.',
            'product_image.dimensions' => 'kích thước không quá 1024px.',
        ];
    }
}
