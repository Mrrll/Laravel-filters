<?php

namespace App\Http\Requests\Rating;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Lang;

class AjaxRatingRequest extends FormRequest
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
        $rating = Rating::where('movie_id', $this->id)->first();

        if ($this->up) {

            $this->merge([
                'yes' => $rating ? $rating->yes + 1 : 1
            ]);
        }
        if ($this->down) {

            $this->merge([
                'no' => $rating ? $rating->no + 1 : 1
            ]);
        }

        $this->merge([
            'movie_id' => $this->id,
            'user_id' => auth()->user()->id,
        ]);


        $yes = isset($this->yes) ? $this->yes : 0;
        $no = isset($this->no) ? $this->no : 0;

        if ($rating) {
            $yes = isset($this->yes) ? $this->yes : $rating->yes;
            $yes = $yes ? $yes : 0;
            $no = isset($this->no) ? $this->no : $rating->no;
            $no = $no ? $no : 0;
        }

        $this->merge([
            'rating' => gmp_sign((($yes - $no) / count(User::all())) * 5) != -1 && gmp_sign((($yes - $no) / count(User::all())) * 5) != 0 ? (($yes - $no) / count(User::all())) * 5 : 0,
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
            'movie_id' => "required|integer",
            "yes" => "integer|nullable",
            "no" => "integer|nullable",
            'rating' => "numeric",
            'user_id' => ["required", "integer", Rule::unique('ratingables', 'ratingable_id')->where('rating_id', $this->id)]
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
            'message' => Lang::get('Warning you have already voted for this :name.', ['name' => strtolower(Lang::get('Movie'))]),
        ]);

    }
}
