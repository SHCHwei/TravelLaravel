<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Repository\PersonRepository;
use App\Repository\OrderRepository;

class OrderController extends Controller
{
    public function orders(OrderRequest $request, PersonRepository $personRepository, OrderRepository $orderRepository)
    {
        $data = $request->all();

        if( $personRepository->nameFormater($data['name']) ){
            return response()->json(["status" => false, "error" => "name is error"], 400);
        }

        $orderRepository->set($data);

        $orderRepository->exchangeRate();


        if( $orderRepository->moneyCheck() ){
            return response()->json(["status" => false, "error" => "Price is over 2000"], 400);
        }

        return response()->json($orderRepository->get(), 200);
    }
}
