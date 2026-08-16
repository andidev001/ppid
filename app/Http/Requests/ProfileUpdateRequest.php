<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'identity_file_path' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf,webp', 'max:5120'],
            'identity_file_path_2' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf,webp', 'max:5120'],
            'identity_file_path_3' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf,webp', 'max:5120'],
            'identity_file_path_4' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf,webp', 'max:5120'],
            'identity_file_path_5' => ['nullable', 'file', 'mimes:jpeg,png,jpg,pdf,webp', 'max:5120'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'province' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:100'],
            'district' => ['nullable', 'string', 'max:100'],
            'village' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'password' => ['nullable', \Illuminate\Validation\Rules\Password::defaults(), 'confirmed'],
        ];
    }
}
