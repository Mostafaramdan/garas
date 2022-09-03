<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateExamsTableRequest extends FormRequest
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
            'date' => 'required',
            'periodType' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'subjects_id' => 'required|exists:subjects,id',
            'grades_id' => 'required|exists:grades,id',
        ];
    }
}
