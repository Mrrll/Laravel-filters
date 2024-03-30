<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Lang;

class AjaxProfileRequest extends FormRequest
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
            'deleteavatar' => 'integer'
        ];
    }

    /**
     * If validator fails return the exception
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {

        return redirect()->back()->with('message', [
            'type' => 'warning',
            'autohide' => 'false',
            'title' => Lang::get('Oops') . '!',
            'message' => Lang::get('Warning your avatar could not be deleted :name.', ['name' => strtolower(Lang::get('Profile'))]),
        ]);
    }
}
