<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateClassRoomTableRequest extends FormRequest
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
        return[
            'teachers_id' => 'required',
            "subjects_id" => 'required',
            'class_number' => 'required|numeric',
            'classes_id' => 'required|numeric',
            'day' => 'required',
        ];
    }

    protected function prepareForValidation()
    {        
        $this->merge([
            'created_at' => now()
        ]);
        $this->request->remove('_token');
        $this->request->remove('_method');
    }
}
