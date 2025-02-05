<?php

namespace App\Repository;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class OrderRepository extends BaseRepository
{

    public function __construct()
    {
        $this->setModel(Order::class);
    }

    /**
     * @param $condition
     * @return Collection
     */
    public function getOrderByCId($condition): Collection
    {

        $data = $this->model::query()
            ->where('cid', $condition['cid'])
            ->where('status', $condition['status'])
//            ->whereBetween('updated_at', [$condition['startDate'], $condition['endDate']])
            ->get();

        foreach ($data as $order) {
            $order->orderConsumer;
        }

        return $data;
    }

    /**
     * @param $condition
     * @return int
     */
    public function checkRoomWithOrder($condition): int
    {
        return $this->model::query()
            ->where('rid', $condition['rid'])
            ->whereIn('status', ['0','1'])
            ->whereBetween('checkin', [$condition['checkin'], $condition['checkout']])
            ->whereBetween('checkout', [$condition['checkin'], $condition['checkout']])
            ->count('id');
    }

    /**
     * @param array $ids
     * @param array $condition
     * @return Collection
     */
    public function getOrderByRId(array $ids, array $condition): Collection
    {

        $data = $this->model::query()
            ->whereIn('rid', $ids)
            ->where('status', $condition['status'])
            ->whereBetween('updated_at', [$condition['startDate'], $condition['endDate']])
            ->get();

        foreach ($data as $order) {
            $order->orderConsumer;
            $order->orderRoom;
        }

        return $data;
    }

    /**
     * @param $id
     * @param $condition
     * @return bool|int
     */
    public function update($id, $condition): bool|int
    {
        $lock = Cache::lock('update_order', 60);

        $result = $this->model::query()->where('id', $id)->update($condition);

        $lock->release();
        return $result;
    }
}
