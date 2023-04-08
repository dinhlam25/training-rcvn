<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $dataValidate = [
            'product_name' => ['required', 'min:5'],
            'product_price' => ['required', 'numeric', 'min:0'],
            'is_sales' => ['required'],
        ];

        if (request()->hasFile('product_image')) {
            $dataValidate['product_image'] = [
                'nullable',
                'file',
                'mimes:jpg,png,jpeg',
                'max:2048',
                'dimensions:max_width=1024'
            ];
        }

        return $dataValidate;
    }
    public function messages(): array
    {
        return [
            'product_name.required' => 'Vui lòng nhập tên sản phẩm.',
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
