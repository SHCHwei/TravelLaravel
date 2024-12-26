<?php

namespace App\Repository;

use App\Models\Store;

class StoreRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Store::class);
    }
}
