<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CVRequest extends FormRequest
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
        $companyId = $this->route('company') ?? $this->input('company');
        return [
            'name' => 'required|string|max:255',
            'email'=>['required',
                'email',
                Rule::unique('companies')->ignore($companyId)],
            'file_path' => 'required|mimes:pdf|max:2048', // حجم الملف يجب أن لا يتجاوز 2MB
            'company_id' =>'required|integer'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',
            'file.required' => 'The file field is required.',
            'file.mimes' => 'The file must be a PDF.',
            'file.max' => 'The file may not be greater than 2MB.',
        ];
    }

    /**
     * Custom validation logic.
     *
     * @return void
     */
    
}
