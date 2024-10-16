<?php

namespace App\Http\Requests\Bot;

use Illuminate\Foundation\Http\FormRequest;

class TransactionalBotRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'content' => 'required|string',
            'telegram_bot' => 'required|string',
            'whatsapp_number' => 'required|string',
            'start_message' => 'required|string',
            'language.id' => 'required|integer',
            'language.name' => 'required|string',
            'language_id' => 'required|integer',
        ];
    }

        /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'language_id' => $this->language['id'] ?? null,
        ]);
    }
}
