<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required|max:255',
            'mrp' => 'required|numeric',
            'units' => 'required',
            'discount' => 'required|numeric|max:100',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
            'image' => '',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:200',
            'cities' => 'required|exists:cities,id'
        ];
    }
}
