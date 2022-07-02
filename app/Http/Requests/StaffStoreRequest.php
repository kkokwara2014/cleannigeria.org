<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffStoreRequest extends FormRequest
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
            'lastname'=>'required',
            'firstname'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'password'=>'required',
            'password_confirmation'=>'required',
            'staffcategory_id'=>'required',
            'location_id'=>'required',
            'role_id'=>'required',
        ];
    }
}
