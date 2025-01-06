<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class ConsumerRequest extends BaseFormRequest
{
    public function messages(): array
    {
        return [
            'id.required' => 'id is required',
            'name.required' => 'name is required',
            'gender.required' => 'name is required',
            'birthday.required' => 'birthday is required',
            'email.required' => 'email is required',
            'password.required' => 'password is required',
            'email.email' => 'email format is error',
        ];
    }

    public function register(): array
    {
        return [
            'name' => 'required|max:100',
            'gender' => ['required', Rule::in([0, 1])],
            'birthday' => 'required|date_format:U',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }

    public function consumer_update(): array
    {
        return [
            'id' => 'required',
            'name' => 'required|max:100',
            'gender' => ['required', Rule::in([0, 1])],
            'birthday' => 'required|date_format:U',
        ];
    }

    public function consumer_overview(): array
    {
        return [
            'id' => 'required'
        ];
    }

    public function consumer_changePWD(): array
    {
        return [
            'id' => 'required',
            'newPassword' => 'required|min:8',
            'oldPassword' => 'required|min:8'
        ];
    }

    public function login(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }

    public function logout(): array
    {
        return [];
    }
}
