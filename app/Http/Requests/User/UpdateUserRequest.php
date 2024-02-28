<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'max:255|min:3',
            'username' => 'max:255|min:3|unique:users,username,' . $this->user->id,
            'email' => 'max:255|min:3|unique:users,email,' . $this->user->id,
            'image' => 'nullable|max:255',
            'password' => 'confirmed|min:8',
        ];
    }
}
