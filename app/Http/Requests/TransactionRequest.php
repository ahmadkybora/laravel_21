<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'user_id' => ['bail', 'required', 'exists:users,id'],
            'bank_id' => ['bail', 'required', 'exists:banks,id'],
            'transaction_code' => ['bail', 'required', 'string'],
            'amount' => ['bail', 'required', 'string']
        ];
    }
}
