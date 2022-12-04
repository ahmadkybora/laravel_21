<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => ['bail', 'required', 'string', 'min:2', 'max:150'],
            'description' => ['bail', 'required', 'string', 'min:2', 'max:150'],
            'user_id' => ['bail', 'required', 'exists:users,id'],
            'category_id' => ['bail', 'required', 'exists:article_categories,id'],
            'image' => ['nullable','bail','image','mimes:jpeg,png','max:512']
        ];
    }
}
