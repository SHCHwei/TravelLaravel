<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequestBase;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequestBase
{
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id.required' => 'ID is required',
            'startDate.required' => 'startDate is required',
            'endDate.required' => 'endDate is required',
            'rid.required' => 'rid is required',
            'cid.required' => 'cid is required',
            'checkin.required' => 'checkin is required',
            'checkout.required' => 'checkout is required',
            'money.required' => 'money is required',
            'payType.required' => 'payType is required',
            'payed.required' => 'payed is required',
            'status.required' => 'status is required'
        ];
    }


    public function consumer_orders()
    {
        return [
            'startDate' => 'required|date_format:U',
            'endDate' => 'required|date_format:U',
            'status' => ['required', Rule::in(['0', '1', '2', '3'])]
        ];
    }

    public function consumer_newOrder()
    {
        return [
            'rid' => 'required',
            'cid' => 'required',
            'checkin' => 'required|date_format:U',
            'checkout' => 'required|date_format:U',
            'money' => 'required|numeric',
            'payType' => ['required', Rule::in(['1', '2', '3'])]
        ];
    }

    public function consumer_order()
    {
        return [
            'id' => 'required',
        ];
    }

    public function consumer_payment()
    {
        return [
            'id' => 'required',
            'payed' => ['required', Rule::in(['0', '1', '2'])],
            'payType' => ['required', Rule::in(['1', '2', '3'])]
        ];
    }

    public function consumer_cancelOrder()
    {
        return [
            'id' => 'required'
        ];
    }

    public function store_ordersByStore()
    {
        return [
            'startDate' => 'required|date_format:U',
            'endDate' => 'required|date_format:U',
            'status' => ['required', Rule::in(['0', '1', '2', '3'])]
        ];
    }

    public function store_order()
    {
        return [
            'id' => 'required',
        ];
    }

    public function store_changeOrder()
    {
        return [
            'id' => 'required',
            'payed' => ['required', Rule::in(['0', '1', '2'])],
            'payType' => ['required', Rule::in(['1', '2', '3'])],
            'status' => ['required', Rule::in(['0', '1', '2', '3'])]
        ];
    }
}
