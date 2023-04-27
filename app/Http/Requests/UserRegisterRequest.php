<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'phone_number' => 'required|numeric|digits_between:10,11',
            'email' => 'required|email|unique:users,email',
            'dob' => 'required|date|date_format:Y-m-d',
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', 'confirmed'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $userDOB = request()->get('dob');
            $dateOfBirth = Carbon::parse($userDOB);
            if ($dateOfBirth->age < 18) {
                $validator->errors()->add('dob', 'You are not eligible for registration');
            }
        });
    }
}
