<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolProfileRequest extends FormRequest
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

    protected
    function passedValidation()
    {
        if ($this->has('password')) {
            $this->merge(['password' => bcrypt($this->password)]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'nullable|min:6|confirmed',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'updated_at' => now()
        ]);
        $this->request->remove('_token');
        $this->request->remove('_method');
        $this->request->remove('password_confirmation');
    }
}
