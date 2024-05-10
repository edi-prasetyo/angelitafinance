<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'variant' => ['required', 'string'],
            'number' => ['required', 'string', 'unique:cars'],
            'color' => ['required', 'string'],
            'seat' => ['required', 'string'],
            'fuel' => ['required', 'string'],
            'transmision' => ['required', 'string'],
            'vehicle_certificate' => ['required', 'string']
        ];
    }
}
