<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'email' => 'required|email|unique:admins,email,' . $this->id,
            'password' => 'nullable|confirmed|min:6',
            'phone' => 'required|unique:admins,phone,' . $this->id,
            'roles_id' => 'required|exists:roles,id',
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
