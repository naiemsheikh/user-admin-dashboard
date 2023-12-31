<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'      => 'required|string|min:3|max:60',
            'phone'     => 'required|string|min:11|max:11',
            'email'     => 'required|email|max:60',
            'subject'   => 'required|string|min:3|max:60',
            'message'   => 'required|string|min:3|max:255',
        ];
    }
}
