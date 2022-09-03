<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class sendNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    

    public function authorize()
    {
        $account = request()->account;
        if(!$account || $account->getTable() != 'teachers'){
            abort(response( [
                'status'=>401,
                'errors'=>request()->messages['validateAccount']['403']
            ],200));
        }

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
            'classId'=>"required|integer|exists:classes,id",
            'message'=>'required',
            'apiToken'=>'required'
        ];
    }
    public function messages()
    {
        return [                                             
            'apiToken.required'=>'يجب إدخال التوكن',

            'message.required'=>'يجب إدخال محتوي الاشعار',

            'classId.required'=>'يجب إدخال رقم الفصل ',
            'classId.integer'=>'يجب إدخال رقم الفصل بشكل صحيح ',
            'classId.exists'=>'يجب إدخال رقم الفصل بشكل صحيح ',
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
                'status'=>400,
                'errors'=>$validator->errors()
            ],200));
        }
    }

}
