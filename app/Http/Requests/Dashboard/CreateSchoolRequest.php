<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateSchoolRequest extends FormRequest
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
            'name' => 'nullable|string|min:3',
            'user_name' => 'required|unique:schools,user_name||unique:admins,email',
            'manager' => 'nullable|string',
            'phone' => 'required',
            'phone2' => 'nullable',
            'country' => 'required|string',
            'state' => 'required|string',
            'password' => 'nullable|min:6',
            'stages' => 'required|array|min:1',
        ];
    }

    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         'created_at' => now()
    //     ]);
    //     $this->request->remove('_token');
    //     $this->request->remove('_method');
    //     $this->request->remove('password_confirmation');

    // }
}
