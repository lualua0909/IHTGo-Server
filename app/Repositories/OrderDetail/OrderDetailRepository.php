<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 27/6/2018
 * Time: 10:27 AM
 */

namespace App\Repositories\OrderDetail;


use App\Models\OrderDetail;
use App\Repositories\EloquentRepository;

class OrderDetailRepository extends EloquentRepository implements OrderDetailRepositoryContract
{

    public function getModel()
    {
        return OrderDetail::class;
    }

    public function updateOderDetailByCondition(array $condition, array $data)
    {
        if ($data && !empty($data)){
            return $this->_model->where($condition)->update($data);
        }
    }
}