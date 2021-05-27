<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacterUpdateRequest extends FormRequest
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
     * Get the validation rules that apply to thes request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:characters,id'
        ];
    }
}
