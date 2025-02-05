<?php

namespace App\Http\Requests;


class StoreRequest extends BaseFormRequest
{
    /**
     * @return string[]
     */
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

    public function store_register(): array
    {
        return [
            'name' => 'required|max:100',
            'address' => 'required',
            'personInCharge' => 'required|max:100',
            'email' => 'required|email',
            'description' => 'required|max:250',
            'password' => 'required|min:8'
        ];
    }

    public function store_update(): array
    {
        return [
            'id' => 'required',
            'name' => 'required|max:100',
            'address' => 'required',
            'personInCharge' => 'required|max:100',
            'description' => 'required|max:250',
        ];
    }

    public function store_changePWD(): array
    {
        return [
            'id' => 'required',
            'newPassword' => 'required|min:8',
            'oldPassword' => 'required|min:8'
        ];
    }

    public function store_login(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }

    public function store_logout(): array
    {
        return [];
    }
}
