<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 27/6/2018
 * Time: 10:27 AM
 */

namespace App\Repositories\OrderDetail;


interface OrderDetailRepositoryContract
{
    /**
     * @param array $condition
     * @param array $data
     * @return mixed
     */
    public function updateOderDetailByCondition(array $condition, array $data);
}