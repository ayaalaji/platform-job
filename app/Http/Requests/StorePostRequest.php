<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title'=>['required'],
            'job_role'=>['required'],
            'career_level'=>['required'],
            'experience_needed'=>['required'],
            'job_title'=>['required'],
            'keywords'=>['required'],
            'name'=>['required'],
            'address'=>['required'],
            'company_id'=>['required'],
        ];
    }
}
