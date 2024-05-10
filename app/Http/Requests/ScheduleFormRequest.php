<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'over_time' => ['required', 'string'],
            'fuel_amount' => ['required', 'string'],
            'parking_amount' => ['required', 'string'],
            'toll_amount' => ['required', 'string'],
        ];
    }
}
