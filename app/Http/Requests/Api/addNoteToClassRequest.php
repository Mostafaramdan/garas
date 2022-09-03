<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class addNoteToClassRequest extends FormRequest
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
        $this->checkForToken();
        return [
            // 'classCode'=>"required|integer|between:10000,999999|exists:classes,code",
            'note'=>'required',
            'apiToken'=>'required',
            'classRoomId'=>'required|exists:class_rooms_tables,id'
        ];
    }
    public function messages()
    {
        return [
            'apiToken.required'=>'يجب إدخال التوكن',

            'note.required'=>'يجب إدخال محتوي الملاحظة',

            'classRoomId.required'=>'يجب اختيار الحصة',
            'classRoomId.exists'=>'يجب اختيار الحصة بشكل صحيح',

            'code.required'=>'يجب إدخال الكود ',
            'code.numeric'=>'يجب إدخال الكود بشكل صحيح ',
            'code.between'=>'يجب ان لا يقل الكود عن 5 أرقام الكود بشكل صحيح ',
            'code.between'=>'الكود غير موجود ',
        ];
    }
    public function checkForToken()
    {
        if(!request()->account || request()->account->getTable() != 'teachers')
            abort( response([
                'status'=> 200,
                'message'=> request()->messages['validateAccount'][403],
                ],
            200) 
        );
    }
}
