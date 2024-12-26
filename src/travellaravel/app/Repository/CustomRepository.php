<?php

namespace App\Repository;

use App\Models\Consumer;
use Illuminate\Support\Facades\Hash;

class CustomRepository extends BaseRepository
{

    public function __construct()
    {
        $this->setModel(Consumer::class);
    }
}
