<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeypersonnelStoreRequest extends FormRequest
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
            'fullname'=>'required',
            'role_id'=>'required',
            'biography'=>'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:10000',
        ];
    }
}
