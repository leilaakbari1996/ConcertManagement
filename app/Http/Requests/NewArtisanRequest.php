<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewArtisanRequest extends FormRequest
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
            'full_name' => ['required','min:2'],
            'category_id' => ['required','exists:categories,id'],
            'avator' => ['required','file','mimes:png,jpg,jpeg,gif'],
            'background' => ['required','file','mimes:png,jpg,jpeg,gif']
        ];
    }
}
