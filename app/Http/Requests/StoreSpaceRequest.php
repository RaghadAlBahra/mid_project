<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSpaceRequest extends FormRequest
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
            'center_id'=>['required','exists:centers,id'],
            'name'=>['required','string','min:3','max:20'],
            'description'=>['nullable','string','max:20','min:2'],
            'type'=>['required','string','min:3','max:20'],
            'maximum_capacity'=>['required','integer','min:1'],
            'hourly_price'=>['required','numeric','min:0'],
            'status'=>['required','in:Available,Maintenance']
        ];
    }
}
