<?php

namespace App\Http\Requests;


class RoomTypeRequest extends BaseFormRequest
{
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
