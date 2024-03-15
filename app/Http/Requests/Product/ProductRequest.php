<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return match($this->method()) {
            'POST' => [
                'category_id' => ['required'],
                'code' => ['required'],
                'name' => ['required', 'unique:products,name'],
                'description' => ['required'],
                'price' => ['required'],
                'qty' => ['required'],
                'manufactured_at' => ['required', 'date'],
                'expired_at' => ['required', 'date'],
            ],
            'PUT' => [
                'option' => ['required_without_all:supplier_id,category_id,brand_id,name,description,is_customized,price,product_variety_name,product_variety_price, product_variety_qty, qty'],
                'category_id' => ['required_without:option'],
                'code' => ['required'],
                'name' => ['required_without:option', \Illuminate\Validation\Rule::unique('products', 'name')->ignore($this->product)],
                'description' => ['required_without:option'],
                'price' => ['required_without:option'],
                'qty' => ['required_without:option'],
                'manufactured_at' => ['required', 'date'],
                'expired_at' => ['required', 'date'],
            ],
        };
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The category field is required.',
            'name.unique' => 'The product has already been exist',
            'price.required_without' => 'The price field is required when variety is not present.',
            'option.required_without' => 'The option field is required when there is no input request.',
        ];
    }
}