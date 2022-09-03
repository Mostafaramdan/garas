<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolRequest extends FormRequest
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
        $this->merge([
            'updated_at' => now()
        ]);
        $this->request->remove('_token');
        $this->request->remove('_method');
        $this->request->remove('password_confirmation');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'user_name' => 'required|unique:schools,user_name,' .$this->id,
            'manager' => 'required|string',
            'phone' => 'required',
            'phone2' => 'nullable',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'password' => 'nullable|min:6|confirmed',
        ];
    }
}
