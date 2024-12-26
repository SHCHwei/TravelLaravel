<?php

namespace App\Repository;

use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model $model
     */
    protected $model;

    /**
     * @var array $attributes
     */
    protected $attributes = [];

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function set($data)
    {
        foreach ($data as $key => $value)
        {
            $this->attributes[$key] = $value;
        }
    }


    public function get($list): array
    {
        $returnData = array();

        foreach ($list as $key)
        {
            if(isset($this->attributes[$key])){
                $returnData[$key] = $this->attributes[$key];
            }
        }

        return $returnData;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function create($condition)
    {
        $result = [];

        try{
            $result = $this->model::query()->create($condition);
        }catch (\Exception $e){
            return ['status' => false, 'message' => "Database error"];
        }

        return ['status' => true, 'data' => $result];
    }

    public function one($id)
    {
        return $this->model::query()->where('id', $id)->first();
    }

    public function update($id, $condition)
    {
        $builder = $this->model::query()->where('id', $id)->first();

        foreach ($condition as $key => $value)
        {
            $builder->$key = $value;
        }

        return $builder->save();
    }


    /**
     * @param array $columns
     * @param array $condition
     * @return Collection
     */
    public function query(array $columns, array $condition)
    {
        $builder = $this->model::query();

        foreach ($condition as $key => $value) {
            $builder->where($key, $value);
        }

        return $builder->get($columns);
    }
}
