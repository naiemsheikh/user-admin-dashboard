<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
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
    // public function expectsJson()
    // {
    //     return true;
    // }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'department' => 'nullable',
            'bookingfrom' => 'nullable',
            'sendername' => 'nullable',
            'sendercontact' => 'nullable',
            'receiveraddr' => 'nullable',
            'receivercontact' => 'nullable',
            'servicetype' => 'required_if:data_source,INTERNAL_TRACKING',
            'itemdescription' => 'nullable',
            'complainer_no' => 'nullable',
            'corporatecode' => 'nullable',
            'Company_Name' => 'nullable',
            'Customer_Type' => 'nullable',
            'E_mail' => 'required_if:data_source,PUBLIC_TRACKING',
            'Booking_CN' => 'required',
            'Complain_Type' => 'nullable',
            'Booking_Date' => 'nullable',
            'Message' => 'required_if:data_source,PUBLIC_TRACKING',
            'Complain_Date' => 'nullable',
            'Receiver' => 'nullable',
            'Forword_By' => 'nullable',
            'Forword_To' => 'nullable',
            'Reply' => 'nullable',
            'Reply_Date' => 'nullable',
            'Remarks1' => 'nullable',
            'psl_receiver' => 'nullable',
            'destination' => 'nullable',
            'Status' => 'nullable',
            'Status1' => 'nullable',
            'CalledTime' => 'nullable',
            'agent_name' => 'nullable',
            'itemName' => 'nullable',
            'complainByID' => 'nullable',
            'complainByType' => 'nullable',
            'partycode' => 'nullable',
            'data_source' => ['required', 'in:PUBLIC_TRACKING,INTERNAL_TRACKING']
        ];
    }
}
