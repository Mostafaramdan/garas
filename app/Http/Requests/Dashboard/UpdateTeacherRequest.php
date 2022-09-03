<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'phone' => 'required|unique:teachers,phone,'.$this->id,
            'subject_ids' => 'required',
        ];
    }
    protected function prepareForValidation()
    {        
        $this->merge([
            'updated_at' => now()
        ]);
        $this->request->remove('_token');
        $this->request->remove('_method');
    }
}
