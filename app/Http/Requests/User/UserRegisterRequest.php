<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRegisterRequest extends FormRequest
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
        return [
            'name'  => 'required|string|max:200',
            'phone_number'  => 'required|string|max:10|unique:client,phone_number',
            'email' => 'required|email|max:100|unique:client,email',
            'password' =>'required|string|min:8|confirmed',
        ];
    }
}
