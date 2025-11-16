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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

<<<<<<< HEAD
            'phone' => ['nullable', 'string'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],

=======
            'phone' => ['nullable', 'string', 'max:20'],

            'linkedin_url' => [
                'nullable',
                'regex:/^(https?:\/\/)?(www\.)?linkedin\.com\/in\/[A-Za-z0-9_-]+\/?$/'
            ],
            'resume_path' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            
>>>>>>> 205c9bfc7ace6304baa8480ed1d5e068c4a5cacc
        ];
    }
}
