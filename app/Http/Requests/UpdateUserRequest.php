<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|alpha|unique:users,name',
            'job_title' => 'alpha',
            'phone' => 'numeric|min:11',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|confirmed|min:8',
            'modules' => 'required'
        ];
    }

    public function messages()
    {
        return ['modules.required' => 'The Access Permissions field is required.'];
    }
}