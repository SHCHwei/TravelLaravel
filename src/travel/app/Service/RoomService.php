<?php

namespace App\Service;


class RoomService
{
    /**
     * @param $rooms
     * @return array
     */
    public function list($rooms): array
    {
        $arr = [];

        foreach($rooms as $room)
        {

            $arr[] = [
                'id' => $room->id,
                'name' => $room->name,
                'description' => $room->description,
                'price' => $room->price,
                'count' => $room->count,
                'hotel' => $room->hotelStore->name,
                'address' => $room->hotelStore->address,
            ];
        }

        return $arr;
    }


}
