<?php

namespace App\Repository;

use App\Models\Consumer;

class CustomRepository extends BaseRepository
{

    public function __construct()
    {
        $this->setModel(Consumer::class);
    }
}
