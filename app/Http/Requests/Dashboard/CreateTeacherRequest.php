<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
class CreateTeacherRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => 'required|unique:teachers',
            'subject_ids' => 'required',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge(['custom_class_room_in_day'=>AuthLogged()->class_rooms_in_days->where('is_active',1)->pluck('id')]);

    }
}
 