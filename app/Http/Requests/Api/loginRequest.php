<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Models\classes;
use App\Models\teachers;
use App\Models\students;
use  App\Http\Resources\Api\studentResource;
use  App\Http\Resources\Api\teacherResource;

class loginRequest extends FormRequest
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
        $this->table = request()->type == 'student' ? 'classes' : 'teachers';
        return [
            'type'=>'required|in:teacher,student',
            'deviceId'=>'required',
            'name'=>'required_if:type,student|min:12',
            'code'=>"required|integer|between:10000,999999|exists:{$this->table},code"
        ];
    }

    public function messages()
    {

        return [
            'type.required' => 'يجب إدخال النوع',
            'type.in' => 'يجب إدخال النوع بشكل صحيح [student | teacher]',

            'name.required_if'=>'يجب إدخال الاسم ',
            'name.required'=>'يجب إن لا يقل عدد حروف الاسم عن 12 حرف  ',

            'code.required' => 'يجب إدخال الكود ',
            'code.exists' => 'كود غير صحيح',
            'code.integer' => 'يجب إدخال الكود بشكل صحيح ',
            'code.between' => 'يجب ان لا يقل الكود عن 5 أرقام الكود بشكل صحيح ',

            'deviceId.required' => 'يجب إدخال رقم الجهاز'
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
        $this->vlidateAccount();
    }

    function vlidateAccount()
    {
        if ($this->type == 'teacher') {
            $teacher = teachers::updateOrCreate(['code' => $this->code])->createToken();
            if (! $teacher->is_active ) {
                abort(response([
                    'status' => 400,
                    'errors' => request()->messages['validateAccount']['402']
                ], 200));
            }
            request()->request->add([
                'resource' => teacherResource::class,
                'account' => $teacher
            ]);

        } else {
            $student = students::updateOrCreate([
                'deviceId' => $this->deviceId,
                'classes_id' => classes::firstWhere(['code' => $this->code])->id,
            ])->createToken();
            request()->request->add([
                'resource' => studentResource::class,
                'account' => $student
            ]);
        }

    }
}
