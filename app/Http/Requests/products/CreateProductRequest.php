<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:200',
            'cities' => 'required|exists:cities,id'
        ];
    }
}
