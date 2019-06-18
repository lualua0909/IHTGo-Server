<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 2:03 PM
 */

namespace App\Repositories\Car;


interface CarRepositoryContract
{
    /**
     * @return mixed
     */
    public function getHistoryDelivery($id);
}