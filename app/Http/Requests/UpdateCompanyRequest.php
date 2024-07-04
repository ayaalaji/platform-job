<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;



class UpdateCompanyRequest extends FormRequest
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
    public function rules($id): array
    {
        $companyId = $this->route('company') ?? $this->input('company');
        return [
            'name' => 'string|max:255',
            'email' => [
                'email',
                Rule::unique('companies')->ignore($companyId)
            ],
            'password' => 'confirmed|string|min:8',
            'address' => 'string|max:50',
            'descraption' => 'string|max:255',
            'manager' => 'string',
            'manager_phone' => 'string',
        ];    
    }

}
