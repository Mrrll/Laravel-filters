<?php

namespace App\Http\Requests\Auth\Password;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class ResetRequest extends FormRequest
{
    protected $errorBag = 'reset';
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
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed',
        ];
    }
    /**
     * The function attributes() in PHP returns an array.
     *
     * @return An array is being returned.
     */
    public function attributes()
    {
        return [
            "email" => strtolower(Lang::get('Email')),
            "password" => strtolower(Lang::get('Password')),
            "password_confirmation" => strtolower(Lang::get('Password Confirmation')),
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.exists' => Lang::get('The email does not exist in the database'),
        ];
    }
}
