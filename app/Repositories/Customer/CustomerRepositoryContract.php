<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 1:01 PM
 */

namespace App\Repositories\Customer;


use Illuminate\Http\Request;

interface CustomerRepositoryContract
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getCustomerDataTable(Request $request);

    /**
     * @param $id
     * @param $start
     * @param $end
     * @return mixed
     */
    public function getDebtCustomer($id, $start, $end);

    /**
     * @param Request $request
     * @return mixed
     */
    public function ajaxSelect2(Request $request);
}