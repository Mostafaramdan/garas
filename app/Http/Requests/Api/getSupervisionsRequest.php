<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class getSupervisionsRequest extends FormRequest
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
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */

    public function messages()
    {
        return [
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
        if( request()->account->getTable() == 'students' ){
            $this->merge(['schools_id'=>request()->account->class->grade->stage->schools_id]);
        }elseif( request()->account->getTable() == 'teachers' ){
            $this->merge(['schools_id'=>request()->account->schools_id]);
        }
    }
}
