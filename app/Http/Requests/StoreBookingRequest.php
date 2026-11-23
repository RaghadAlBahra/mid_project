<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            //ماحطيت 'customer_id'مشان ما المستخدم يغير ايديتو عكيفو
            //وماحطيت'total_price' مشان ما المستخدم يغير العداد عكيفو
            //'status'وهي ماحطيتا لانو الادمن الي بحدد الحالة مو المستخدم
            'space_id' => ['required', 'exists:spaces,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'number_of_people' => ['required', 'integer', 'min:1']
        ];
    }
}
