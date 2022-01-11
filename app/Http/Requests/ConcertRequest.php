<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConcertRequest extends FormRequest
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
            'title' => ['required','min:2'],
            'artist_id' => ['required','exists:artists,id'],
            'description' => ['required','min:2'],
            'starts_at' => ['required','date','before:ends_at'],
            'ends_at' => ['required','date','after:starts_at'],
            'is_published' => ['nullable']
        ];
    }
}
