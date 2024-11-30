<?php

namespace App\Repository;

use App\Contracts\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{

    public function set($data)
    {
        foreach ($data as $key => $value)
        {
            $this->$key = $value;
        }
    }


    public function get($list): array
    {
        $returnData = array();

        foreach ($list as $key)
        {
            if(isset($this->$key)){
                $returnData[$key] = $this->$key;
            }
        }

        return $returnData;
    }
}
