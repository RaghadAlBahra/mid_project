<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'job_title' => ['required', 'string', 'max:225'],
            'hire_date' => ['required', 'date'],
            'name' => ['required', 'string', 'max:225'],
            'email' => ['required', 'email', 'max:225'],
            'password' => ['nullable', 'string', 'max:10', 'min:3', 'confirmed'],
            'phone_number' => ['required', 'string', 'max:225'],
            'address' => ['required', 'string', 'max:225'],

        ];
    }
}
