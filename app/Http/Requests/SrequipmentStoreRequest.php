<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SrequipmentStoreRequest extends FormRequest
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
            'store_id'=>'required|integer',
            'category_id'=>'required|integer',
            'itemunit_id'=>'required|integer',
            // 'user_id'=>'required',
            'supplier_id'=>'required|integer',
        ];
    }
}
