<?php

namespace App\Http\Requests\Registers;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DataRequestAdapter;

class RegistersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'register' => 'required|array',
            'register.*.name' => 'required|string|exists:registers,name,deleted_at,NULL|min:4'
        ];
    }

    public function validationData() //this method it going to be call by itself
    {
        return DataRequestAdapter::transformToUpper($this->all());
    }
}
