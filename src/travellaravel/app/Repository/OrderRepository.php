<?php

namespace App\Repository;

class OrderRepository extends BaseRepository
{
    public $id;
    public $price;

    public $name;
    public $address;
    public $currency;

    private $rate = 31;

    public function get($list = ['id', 'name', 'price', 'address', 'currency']): array
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

    public function exchangeRate()
    {
        if($this->currency == 'USD'){
            $data = ['price' => $this->price * $this->rate, 'currency' => "TWD"];
            $this->set($data);
        }
    }

    public function moneyCheck()
    {
        if ((int) $this->price <= 2000) {
            return false;
        }

        return true;
    }
}
