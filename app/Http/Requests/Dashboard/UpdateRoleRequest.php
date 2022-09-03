<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'name' => 'required',
            'permission' => 'nullable|min:8',
        ];
    }
    protected function prepareForValidation()
    {
       
        $permissions=[];
        foreach(config('permissions.modules') as $module){
            $moduleName=$module['name'];
            $permissions[]=[
                $this->{$moduleName.'-read'}?$moduleName.'-read':'',
                $this->{$moduleName.'-create'}?$moduleName.'-create':'',
                $this->{$moduleName.'-update'}?$moduleName.'-update':'',
                $this->{$moduleName.'-delete'}?$moduleName.'-delete':'',
            ];
        }
        $this->merge([
            'created_at' => now(),
            'permissions' => json_encode($permissions,true)
        ]);
    }
}
