<?php

namespace App\Http\Requests\Filter;

use Illuminate\Foundation\Http\FormRequest;

class AjaxFilterRequest extends FormRequest
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
            "search" => "string|nullable",
            "gender" => "string|nullable",
            "tags" => "array|nullable",
            "stars" => "numeric|nullable"
        ];
    }
}
