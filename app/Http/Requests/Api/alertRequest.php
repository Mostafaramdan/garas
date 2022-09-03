<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class alertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $account = request()->account;
        if(!$account ){
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
            'apiToken'=>'required',
            'switchNotification'=>'required|in:0,1',
            'alertBeforeClassRoom'=>'required|in:0,1',
            'alertBeforeClassRoomAt'=>'required|int',
            'alertBeforeEndClassRoom'=>'required|in:0,1',
            'alertBeforeEndClassRoomAt'=>'required|int',
        ];
    }
    public function messages()
    {
        return [
            'apiToken.required'=>'يجب إدخال التوكن',

            'switchNotification.required'=>'يجب إدخال تفعيل الاشعارات',

            'alertBeforeClassRoom.required'=>'يجب إدخال تفعيل التنبيهات قبل الدرس',
            'alertBeforeClassRoom.in'=>'يجب إدخال تفعيل التنبيهات قبل الدرس بشكل صحيح  0أو1',

            'alertBeforeClassRoomAt.required'=>'يجب إدخال وقت التنبيهات قبل الدرس',
            'alertBeforeClassRoomAt.int'=>'يجب إدخال وقت التنبيهات قبل الدرس بشكل صحيح',

            'alertBeforeEndClassRoom.required'=>'يجب إدخال تفعيل التنبيهات بعد الدرس',
            'alertBeforeEndClassRoom.in'=>'يجب إدخال تفعيل التنبيهات بعد الدرس بشكل صحيح  0أو1',

            'alertBeforeEndClassRoomAt.required'=>'يجب إدخال وقت التنبيهات بعد الدرس',
            'alertBeforeEndClassRoomAt.int'=>'يجب إدخال وقت التنبيهات بعد الدرس بشكل صحيح',


        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */

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

    /**
     * check schools id .
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return abort
     */

    protected function prepareForValidation()
    {        
        if(request()->account){
            if( request()->account->getTable() == 'students' ){
                $this->merge(['schools_id'=>request()->account->class->grade->stage->schools_id]);
            }elseif( request()->account->getTable() == 'teachers' ){
                $this->merge(['schools_id'=>request()->account->schools_id]);
            }
        }


    }
}
