<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class StoreTagRequest extends FormRequest
{
    protected $errorBag = 'tag';
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
            'name' => 'required|string|unique:tags,name,'.$this->tag_id,
        ];
    }

    public function attributes()
    {
        return [
            "name" => strtolower(Lang::get('Name')),
        ];
    }
}
