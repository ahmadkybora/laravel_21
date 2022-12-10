<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => ['nullable', 'bail', 'string', 'min:2', 'max:150'],
            'last_name' => ['nullable', 'bail', 'string', 'min:2', 'max:150'],
            'postal_code'=>['nullable', 'bail', 'string', 'min:2', 'max:150'],
            'city' => ['nullable', 'bail', 'exists:cities,id'],
            'home_address'=>['nullable', 'bail', 'string','min:5', 'max:300'],
            'work_address'=>['nullable', 'bail', 'string','min:5', 'max:300'],
            'avatar' => ['nullable', 'bail', 'image', 'mimes:jpeg,png', 'max:512']
        ];
    }
}
