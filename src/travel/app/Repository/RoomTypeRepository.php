<?php

namespace App\Repository;

use App\Models\RoomType;
use Illuminate\Database\Eloquent\Collection;

class RoomTypeRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(RoomType::class);
    }

    /**
     * @param array $condition
     * @return Collection
     */
    public function rooms(array $condition): Collection
    {
        $builder = $this->model::query()
            ->whereLike("name","%".$condition['name']."%")
            ->whereBetween ("price", [$condition['down'], $condition['top']]);

        $data = $builder->get();

        foreach ($data as $hotel) {
            $hotel->hotelStore;
        }

        return $data;
    }

}
