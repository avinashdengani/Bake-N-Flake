<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => '',
            'description' => 'max:255',
            'mrp' => 'numeric',
            'discount' => 'numeric|max:100',
            'category_id' => 'exists:categories,id',
            'status' => '',
            'image' => '',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:200'
        ];
    }
}
