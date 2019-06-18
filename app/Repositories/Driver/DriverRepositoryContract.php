<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 2:15 PM
 */

namespace App\Repositories\Driver;


use Illuminate\Http\Request;

interface DriverRepositoryContract
{
    /**
     * @param Request $request
     * @param bool $driverId
     * @return mixed
     */
    public function getHistoryDelivery(Request $request, $driverId = false);

    /**
     * @return mixed
     */
    public function getLngLatDriver();

    /**
     * @param Request $request
     * @return mixed
     */
    public function ajaxGetDriver(Request $request);

    /**
     * @param $id
     * @return mixed
     */
    public function getLastOrderByDriverID($id);

    /**
     * @param array $condition
     * @param bool $first
     * @param array $select
     * @return mixed
     */
    public function findByCondition(array $condition, $first=true, $select=['*']);
}