<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoomTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

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

    public function messages(): array
    {
        return [
            'id.required' => 'id is required',
            'name.required' => 'name is required',
            'description.required' => 'description is required',
            'price.required' => 'price is required',
            'count.required' => 'count is required',
            'sid.required' => 'sid is required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors();
        throw new HttpResponseException(response()->json(['status' => false, 'error' => $message->first()], 400));
    }


    public function store_new_room(): array
    {
        return [
            'name' => 'required|min:2',
            'description' => 'required|min:2',
            'price' => 'required|numeric|min:0',
            'count' => 'required|numeric|min:0'
        ];
    }

    public function store_update_room(): array
    {
        return [
            'id' => 'required',
            'name' => 'required|min:2',
            'description' => 'required|min:2',
            'price' => 'required|numeric|min:0',
            'count' => 'required|numeric|min:0'
        ];
    }

    public function rooms(): array
    {
        return [
            'name' => 'nullable|string|max:20',
            'down' => 'nullable|numeric|min:1',
            'top'  => 'nullable|numeric|max:100000',
        ];
    }
}
