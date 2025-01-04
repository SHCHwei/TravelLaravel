<?php

namespace App\Service;

use App\Repository\OrderRepository;
use App\Repository\RoomTypeRepository;
use Illuminate\Support\Facades\Cache;


class OrderService
{

    private $repository;
    private $roomTypeRepository;

    public function __construct(OrderRepository $orderRepository, RoomTypeRepository $roomTypeRepository)
    {
        $this->repository = $orderRepository;
        $this->roomTypeRepository = $roomTypeRepository;
    }

    /**
     * @param $condition
     * @return array
     */
    public function getOrders($condition): array
    {

        $data = $this->repository->getOrderByCId($condition);

        foreach ($data as $order)
        {
            $order->payed = payed($order->payed);
            $order->payType = payType($order->payType);
            $order->status = orderStatus($order->status);
            $order->room = $order->orderCustomer->name;
        }

        return $data->toArray();
    }

    /**
     * @param $condition
     * @return array
     */
    public function newOrder($condition): array
    {
        // 先上鎖
        $lock = Cache::lock('new_order', 60);

        // 計算目前的房間數量 避免超賣

        // 1. 房間數量
        $roomLimit = $this->roomTypeRepository->query(['count'], ['id' => $condition['rid']]);


        // 2. 目前訂單數
        $check = $this->repository->checkRoomWithOrder($condition);

        // 如果有剩餘房間，則建立訂單。如果否 return message
        if($roomLimit == $check)
        {
            $lock->release();
            return ['status' => false, 'message' => '訂房已滿'];
        }


        $condition['payed'] = '0';
        $condition['status'] = '0';
        $result = $this->repository->create($condition);

        //解鎖
        $lock->get();
        return $result;
    }

    /**
     * @param $id
     * @return array
     */
    public function getOrderById($id): array
    {
        $data = $this->repository->one($id);

        $data->orderCustomer;
        $data->payed = payed($data->payed);
        $data->payType = payType($data->payType);
        $data->status = orderStatus($data->status);

        return $data->toArray();
    }

    /**
     * @param $condition
     * @return bool|int
     */
    public function payment($condition): bool|int
    {
        $condition['status'] = $condition['payType'] == 2 ? '1' : '0';
        $id = $condition['id'];
        unset($condition['id']);

        return $this->repository->update($id, $condition);
    }


    /**
     * @param $id
     * @return bool|int
     */
    public function cancel($id): bool|int
    {
        return $this->repository->update($id, ['status' => '3']);
    }

    /**
     * @param $condition
     * @return array
     */
    public function ordersByStore($condition): array
    {
        $rooms = $this->roomTypeRepository->query(['id'], ['sid' => session('sid')])->toArray();

        $data = $this->repository->getOrderByRId($rooms, $condition);

        foreach ($data as $order)
        {
            $order->payed = payed($order->payed);
            $order->payType = payType($order->payType);
            $order->status = orderStatus($order->status);
        }

        return $data->toArray();
    }


    /**
     * @param $id
     * @param $condition
     * @return bool|int
     */
    public function operationByStore($id, $condition): bool|int
    {
        return $this->repository->update($id, $condition);
    }
}
