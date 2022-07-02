<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MobilizationStoreRequest extends FormRequest
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
            'membcomp'=>'required',
            'notifier'=>'required',
            'mobilephone'=>'required',
            'email'=>'required|email',
            'dateofact'=>'required',
            'timeofact'=>'required',
            'spilldate'=>'required',
            'spillstatus'=>'required',
            'environmenttype'=>'required',
            'numofpersonnel'=>'required',
            'safetyinfo1'=>'required',
            'safetyinfo2'=>'required',
            'provision'=>'required',
        ];
    }
}
