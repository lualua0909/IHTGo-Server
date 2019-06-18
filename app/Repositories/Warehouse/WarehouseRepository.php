<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 2:04 PM
 */

namespace App\Repositories\Warehouse;


use App\Models\Warehouse;
use App\Repositories\EloquentRepository;

class WarehouseRepository extends EloquentRepository implements WarehouseRepositoryContract
{

    public function getModel()
    {
        return Warehouse::class;
    }
}