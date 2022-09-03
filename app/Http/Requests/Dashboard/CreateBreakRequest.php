<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateBreakRequest extends FormRequest
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
            'after_class_room' => 'required|numeric',
            'time' => 'required',
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
