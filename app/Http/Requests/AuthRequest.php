<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        switch(Route::currentRouteName())
        {
            case 'login':
                return [
                    'username' => ['bail', 'required', 'string', 'min:5', 'max:30'],
                    'password' => ['required', 'string', 'min:8', 'max:15'],    
                ];

            case 'register':
                return [
                    'first_name' => ['bail', 'required', 'string', 'min:2', 'max:150'],
                    'last_name' => ['bail', 'required', 'string', 'min:2', 'max:150'],
                    'postal_code'=>['bail','required','string','min:2','max:150'],
                    'city' => ['bail', 'required', 'exists:cities,id'],
                    'home_address'=>['bail','required','string','min:5','max:300'],
                    'work_address'=>['bail','required','string','min:5','max:300'],
                    'avatar' => ['nullable','bail','image','mimes:jpeg,png','max:512']
                ];
        }
    }
}
