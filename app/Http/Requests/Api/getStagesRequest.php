<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class getStagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'apiToken'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'apiToken.required'=>'يجب إدخال التوكن',
        ];
    }
    public function checkForToken()
    {
        if(!request()->account || request()->account->getTable() != 'teachers')
            abort( response([
                'status'=> 401,
                'message'=> request()->messages['validateAccount'][403],
                ],
            200) 
        );
    }
}
