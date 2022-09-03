<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertisementRequest extends FormRequest
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
            'title_ar' => 'required|string|min:3,'.$this->id,
            'title_en' => 'required|string|min:3,'.$this->id,
            'created_at' => 'required',
            'image' => 'nullable|image'.$this->id,
            'video' => 'nullable|file,'.$this->id,
        ];
    }
}
