<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|min:2|max:255',
            'email' => 'sometimes|string|email|unique:users,email',
            'username' => 'sometimes|string|max:255|unique:users,username',
            'password' => 'sometimes|string|min:8',
            'country' => 'sometimes|string|max:255',
            'bio' => 'sometimes|string',
            'avatar' => 'sometimes|string'
        ];
    }
}
