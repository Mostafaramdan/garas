<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeRequest extends FormRequest
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
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'stages_id' =>'required|exists:stages,id',
            'subjects_ids'=>'required|array',
            'subjects_ids.*'=>'required|distinct',
            'individual_portions'=>'required|array',
            'matrimonial_portions'=>'required|array',
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
