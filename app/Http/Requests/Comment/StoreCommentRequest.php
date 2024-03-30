<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends FormRequest
{
    protected $errorBag = 'comment';
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
            'message' => 'required|string',
            'movie_id' => ["required", "integer", Rule::unique('comments', 'commentable_id')->where('user_id', $this->user_id)],
            'user_id' => ["required", "integer", Rule::unique('comments', 'user_id')->where('commentable_id', $this->movie_id)],
        ];
    }

    public function attributes()
    {
        return [
            "message" => strtolower(Lang::get('Message')),
            "movie_id" => strtolower(Lang::get('Your comment'))
        ];
    }
}
