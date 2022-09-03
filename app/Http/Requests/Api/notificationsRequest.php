<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class notificationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    
        if(!request()->account){
            abort(response( [
                'status'=>401,
                'errors'=>request()->messages['validateAccount']['403']
            ],200));
        }
        if($this->table=='teachers'){            
            if(!request()->account->is_active??0){
                abort(response( [
                    'status'=>406,
                    'errors'=>request()->messages['validateAccount']['402']
                ],200));
            }
        }
       return true;
    }

    public function rules()
    {
        return [
            'apiToken'=>'required',
            'page'=>'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'apiToken.required'=>'يجب إدخال التوكن',
            'page.required'=>'يجب إدخال رقم الصفحة',
            'page.numeric'=>'يجب إدخال رقم الصفحةبشكل صحيح',
        ];
    }
    
    public function withValidator($validator)
    {
        $this->errors($validator);
    }

    /**
     * get the validatation errors .
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return abort
     */

    function errors($validator)
    {
        if($validator->fails()){
            abort(response( [
                'status'=>'error',
                'errors'=>$validator->errors()
            ],200));
        }
    }
}
