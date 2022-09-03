<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class getGradesRequest extends FormRequest
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
            'stageId'=>'required|exists:stages,id'
        ];
    }
    public function messages()
    {
        return [
            "stageId.required"=>"يجب إدخال رقم المرحلة "
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
                'status'=>'error',
                'errors'=>$validator->errors()
            ],200));
        }
    }
}
