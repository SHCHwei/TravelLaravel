<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
            'id' => 'required',
            'name' => 'required',
            'address.*' => 'required',
            'address.city' => 'required',
            'address.district' => 'required',
            'address.street' => 'required',
            'price' => 'required|string',
            'currency' => ['required', Rule::in(['TWD', 'USD']),]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id.required' => 'ID is required',
            'name.required' => 'name is required',
            'address.required' => 'address is required',
            'price.required' => 'price is required',
            'currency.required' => 'currency is required',
            'currency.in' => '只限定TWD，USD兩種',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors();
        throw new HttpResponseException(response()->json(['status' => false, 'error' => $message->first()], 400));
    }
}
