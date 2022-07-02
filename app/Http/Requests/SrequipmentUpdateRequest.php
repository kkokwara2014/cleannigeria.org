<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SrequipmentUpdateRequest extends FormRequest
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
            'name'=>'required',
            'qty'=>'required',
            'status'=>'required',
            'store_id'=>'required',
            'category_id'=>'required',
            'itemunit_id'=>'required',
            'user_id'=>'required',
            'supplier_id'=>'required',
        ];
    }
}
