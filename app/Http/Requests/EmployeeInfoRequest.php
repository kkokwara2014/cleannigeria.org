<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeInfoRequest extends FormRequest
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
            'state_id'=>'required|integer',
            'lga_id'=>'required|integer',
            'location_id'=>'required|integer',
            'title'=>'required',
            'address'=>'required|string',
            'dob'=>'required',
            'maritalstatus'=>'required',
            'qualification'=>'required',
            'profession'=>'required',
            'jobtitle'=>'required',
            'supervisor'=>'required',
            'dateofemployment'=>'required',
            'nextofkin'=>'required',
            'nokaddress'=>'required|string|min:3|max:100',
            'nokphone'=>'required|min:11|max:11',
            'nokrelationship'=>'required',
            'acceptdeclaration'=>'required',
        ];
    }
}
