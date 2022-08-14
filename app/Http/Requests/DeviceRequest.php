<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    // Validation rules for model, brand and release_date field
    public function rules()
    {
        return [
            'model' => 'required',
            'brand' => 'required',
            'release_date' => 'required|date_format:Y/m'
        ];
    }
}
