<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'fname' => 'required',
            'lname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required|numeric|digits:6',
        ];
    }
    public function messages()
    {
        return [
            'fname.required' => 'First Name is required',
            'lname.required' => 'Last Name is required',
            // 'contact_no.digits' => ,
            // 'contact_no.numeric' => 'Please insert a valid ContactRequest No.',
        ];
    }
}
