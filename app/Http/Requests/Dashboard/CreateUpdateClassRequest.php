<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateClassRequest extends FormRequest
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
            'name_ar' => "required|string|min:1",
            'name_en' => "required|string|min:1",
            'grades_id' => 'required_with:id',
            'grades_ids'=>'required_without:id'
        ];
    }
    function columns()
    {
        return [
            'name_ar'=>$this->name_ar,
            'name_en'=>$this->name_en,
            'grades_id'=>$this->grades_id,
            'created_at'=>now()
        ];
    }
}
