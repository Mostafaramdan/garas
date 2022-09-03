<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppSettingRequest extends FormRequest
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
            'email' => 'required|string|email|max:191|unique:app_settings,email,'.$this->id,
            'phone' => 'required|unique:app_settings,phone,'.$this->id,
            'terms_ar' => 'nullable',
            'terms_en' => 'nullable',
            'about_ar' => 'nullable',
            'about_en' => 'nullable',
        ];
    }
}
