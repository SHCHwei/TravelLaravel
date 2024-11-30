<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 */
interface RepositoryInterface
{
    /**
     * @param array $data
     */
    public function set(array $data);

    /**
     * @param array $list
     * @return array
     */
    public function get(array $list): array;
}
