<?php

namespace App\Http\Requests\Movie;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class UpdateMovieRequest extends FormRequest
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
        $this->tags = explode(',', $this->tags);
        if (!is_array($this->tags)) {
            $this->tags = [$this->tags];
        }

        $this->year = trim(Carbon::parse($this->year . "-01-01"));

        $this->title = trim(preg_replace('/[?¿!¡<>=:,+*#@%&()]/', ' ', $this->title));


        $this->merge([
            'tags' => $this->tags,
            'gender_id' => $this->gender,
            'year' => $this->year,
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'description' => trim($this->description)
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
            "title" => "required|string|unique:movies,title," . $this->movie_id,
            "description" => "required|string",
            "year" => "required|date",
            "gender_id" => "required|integer",
            "image" => "image|mimes:png,jpg,jpeg,gif,bmp|nullable",
            "tags" => "array|nullable",
            "user_id" => "required|integer",
        ];
    }

    public function attributes()
    {
        return [
            "title" => strtolower(Lang::get('Title')),
            "description" => strtolower(Lang::get('Description')),
            "year" => strtolower(Lang::get('Year')),
            "gender_id" => strtolower(Lang::get('Gender')),
            "image" => strtolower(Lang::get('Image')),
            "tags" => strtolower(Lang::get('Tags')),
        ];
    }
}
