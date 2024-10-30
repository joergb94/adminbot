<?php

namespace App\Http\Requests\Bot;

use Illuminate\Foundation\Http\FormRequest;

class TurnOnOrOffBotRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return  [
            'id' => 'required|int|exists:bots,id,deleted_at,NULL',
            'active' => 'required',
        ];
    }
}
