<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplainActivityRequest extends FormRequest
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
            'complain_id' => 'required',
            'forward_to' => 'required_if:type, !=, 0',
            'forward_by' => 'required_if:type, !=, 0',
            'complain_type' => 'required',
            'remarks' => 'required_if:type, !=, 0',
            'type' => ['required', 'in:forward,solve,call'],
        ];
    }
}
