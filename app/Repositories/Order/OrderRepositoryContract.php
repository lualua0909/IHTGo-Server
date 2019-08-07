<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 10:54 PM
 */

namespace App\Repositories\Order;


use Illuminate\Http\Request;

interface OrderRepositoryContract
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getList(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function getOrderDataTable(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function ajaxSelect2(Request $request);

    /**
     * @param $id
     * @return mixed
     */
    public function getMapByOrderId($id);
}