<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {

        $paths = explode('/', $this->path());

        unset($paths[0]);

        if(count($paths) > 1)
        {
            $ruleName = implode("_",$paths);
            return $this->{$ruleName}();
        }else{
            return $this->{$paths[1]}();
        }
    }

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

    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors();
        throw new HttpResponseException(response()->json(['status' => false, 'error' => $message->first()], 400));
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
