<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCenterRequest extends FormRequest
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
            'name'=>['required','string','max:20','min:2'],
            'description'=>['nullable','string','max:20','min:2'],
            'address'=>['required','string','max:20','min:2'],
             'city'=>['required','string','max:20','min:2'],
             'country'=>['required','string','max:20','min:2'],
             'contact_number'=>['required','string','max:20','min:2'],
            'latitude'=>['nullable','numeric'],
            'longitude'=>['nullable','numeric'],
            'status'=>['required','in:Active,Inactive'],
        ];
    }
}
