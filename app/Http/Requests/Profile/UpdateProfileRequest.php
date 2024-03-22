<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'name' => ["required", "string", "min:3", Rule::unique('profiles', 'name')->where('last_name', $this->last_name)->ignore($this->profile_id)],
            'last_name' => ["required", "string", "min:3", Rule::unique('profiles', 'last_name')->where('name', $this->name)->ignore($this->profile_id)],
            'address' => 'string|nullable',
            "user_id" => 'required|integer',
            "avatar" => 'image|mimes:png|nullable',
        ];
    }

    /**
     * The function returns an array of lowercase attribute names with their corresponding translated
     * values.
     *
     * @return An array of attribute names where each attribute name is a lowercase version of the
     * corresponding translated string obtained using the Laravel Lang facade.
     */
    public function attributes()
    {
        return [
            "name" => strtolower(Lang::get('Name')),
            "last_name" => strtolower(Lang::get('Last name')),
            "address" => strtolower(Lang::get('Address')),
            "avatar" => strtolower(Lang::get('Avatar')),
        ];
    }
}
