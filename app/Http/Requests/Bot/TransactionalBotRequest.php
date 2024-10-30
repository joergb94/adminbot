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
    public function rules()
    {
        $rules = [
            'name' => 'required|string',
            'content' => 'required|string',
            'description' => 'required|string',
            'telegram_bot' => 'required|string',
            'whatsapp_number' => 'required|string',
            'start_message' => 'required|string',
            'language.id' => 'required|integer',
            'language.name' => 'required|string',
            'language_id' => 'required|integer',
            'flows'=>'required|array',
            'flows.*.name' => ['required', 'string', 'distinct'], 
            'flows.*.description' => 'nullable|string',
            'flows.*.sort' => ['required', 'integer', 'min:1'],
        ];

        if (isset($this->id) && !empty($this->id)) {
            $rules['id'] = 'required|int|exists:bots,id,deleted_at,NULL';
        }

        return $rules;
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
