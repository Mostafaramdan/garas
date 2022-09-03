<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class contactRequest extends FormRequest
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

    public function rules()
    {
        $this->table= request()->type=='student'?'classes':'teachers';
        return [
            'apiToken'=>'required',
            'name'=>'required',
            'message'=>'required',
            'code'=>"integer|between:10000,999999|exists:{$this->table},code"
        ];
    }
    public function messages()
    {
        return [
            'apiToken.required'=>'يجب إدخال التوكن',

            'name.required'=>'يجب إدخال الاسم',
            'message.required'=>'يجب إدخال الرسالة',

            'code.required'=>'يجب إدخال الكود ',
            'code.numeric'=>'يجب إدخال الكود بشكل صحيح ',
            'code.between'=>'يجب ان لا يقل الكود عن 5 أرقام الكود بشكل صحيح ',
            'code.between'=>'الكود غير موجود ',

        ];
    }
    function validateAccount()
    {
        if(!request()->account){
            abort(response( [
                'status'=>'error',
                'errors'=>request()->messages['validateAccount']['403']
            ],200));
        }
        if(request()->account->getTable()=='teachers'){            
            if(!request()->account->is_active){
                abort(response( [
                    'status'=>'error',
                    'errors'=>request()->messages['validateAccount']['402']
                ],200));
            }
        }
       
    }
}
