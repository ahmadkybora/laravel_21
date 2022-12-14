<?php

namespace App\Http\Requests;

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
        return [
            'category_id' => ['bail', 'required', 'exists:product_categories,id'],
            'title' => ['bail', 'required', 'string'],
            'price' => ['bail', 'required', 'string'],
            'description' => ['bail', 'required', 'string'],
            'image' => ['nullable','bail','image','mimes:jpeg,png','max:512']
        ];
    }
}
