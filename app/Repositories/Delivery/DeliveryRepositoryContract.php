<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 2:14 PM
 */

namespace App\Repositories\Delivery;


use Illuminate\Http\Request;

interface DeliveryRepositoryContract
{
    public function getDeliveryDataTable(Request $request);
}