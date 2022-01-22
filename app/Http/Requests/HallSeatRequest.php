<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HallSeatRequest extends FormRequest
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
            'seats' => ['required','array'],
            'seats.*.seat_class_id' => ['required','exists:seat_classes,id'],
            'seats.*.cost' => ['required','integer'],
            'seats.*count' => ['required','integer','gte:4'],
        ];
    }
}
