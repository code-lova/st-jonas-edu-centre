<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateStaffRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'sex' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'blood_group' => 'nullable|string|max:5',
            'genotype' => 'nullable|string|max:5',
            'residential_address' => 'required|string',
            'local_govt_origin' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'nationality' => 'required|string|max:255',
            'class_teacher' => 'nullable|string|max:255',
        ];
    }

     /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        // Log the validation errors
        Log::error('Validation errors occurred:', $validator->errors()->toArray());

        // Call the parent method to maintain default behavior
        parent::failedValidation($validator);
    }
}
