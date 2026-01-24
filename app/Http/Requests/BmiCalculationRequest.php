<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * BMI Calculation Request
 *
 * Handles validation for BMI calculation form.
 * Demonstrates OOP principle: Single Responsibility
 */
class BmiCalculationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // All authenticated users can calculate BMI
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'height' => [
                'required',
                'numeric',
                'min:100',
                'max:250',
            ],
            'weight' => [
                'required',
                'numeric',
                'min:30',
                'max:300',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'height.required' => 'Tinggi badan harus diisi',
            'height.numeric' => 'Tinggi badan harus berupa angka',
            'height.min' => 'Tinggi badan minimal 100 cm',
            'height.max' => 'Tinggi badan maksimal 250 cm',
            'weight.required' => 'Berat badan harus diisi',
            'weight.numeric' => 'Berat badan harus berupa angka',
            'weight.min' => 'Berat badan minimal 30 kg',
            'weight.max' => 'Berat badan maksimal 300 kg',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'height' => 'tinggi badan',
            'weight' => 'berat badan',
        ];
    }
}
