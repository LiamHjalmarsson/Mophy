<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'tmdb_id' => 'sometimes|integer',
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'release_date' => 'sometimes|date',
            'duration' => 'sometimes|integer|min:1',
            'cover' => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
