<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreStudentRequest extends FormRequest
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
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:6|confirmed',
            'sex' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date',
            'passport' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'place_of_birth' => 'required|string|max:255',
            'blood_group' => 'nullable|string|max:5',
            'genotype' => 'nullable|string|max:5',
            'residential_address' => 'required|string',
            'local_govt_origin' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'nationality' => 'required|string|max:255',
            'previous_school' => 'nullable|string|max:255',
            'last_class_passed' => 'nullable|integer|exists:classes,id',
            'current_class_applying' => 'required|integer|exists:classes,id',
            'class_teacher' => 'nullable|string|max:255',


            // Health Information
            'abnormal_behaviour' => 'required|in:Yes,No',
            'description' => 'nullable|string',
            'child_general_health_condition' => 'nullable|string',

            // Parent Information
            'parent_name' => 'required|string|max:255',
            'parent_address' => 'required|string',
            'occupation' => 'nullable|string|max:255',
            'fathers_phone' => 'required|string|max:15',
            'mothers_phone' => 'nullable|string|max:15',
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
