<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionFormRequest extends FormRequest
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
            'customer_id' => ['required', 'string'],
            'car_id' => ['required', 'string'],
            'package_id' => ['required', 'string'],
            'package_name' => ['nullable'],
            'spj' => ['nullable'],
            'pickup_address' => ['required', 'string'],
            'start_date' => ['required'],
            'start_time' => ['required',],
            'end_date' => ['required',],
            'end_time' => ['required',],
            'duration' => ['required', 'string'],
            'price' => ['required', 'string'],
            'discount' => ['nullable', 'string'],
            'down_payment' => ['nullable', 'string'],
            'payment_method' => ['required', 'string'],
            'bbm' => ['nullable', 'string'],
            'toll' => ['nullable', 'string'],
            'parking' => ['nullable', 'string'],
            'meal_cost' => ['nullable', 'string'],
            'lodging_cost' => ['nullable', 'string'],
            'ppn' => ['nullable', 'string'],
            'pph' => ['nullable', 'string'],
            'fee' => ['nullable', 'string'],
            'status' => ['nullable'],
            'all_in' => ['required'],
        ];
    }
}
