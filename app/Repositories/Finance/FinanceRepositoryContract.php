<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 7/17/18
 * Time: 10:04
 */

namespace App\Repositories\Finance;


use Illuminate\Http\Request;

interface FinanceRepositoryContract
{
    /**
     * @param array $condition
     * @param bool $first
     * @param array $filed
     * @return mixed
     */
    public function getByCondition(array $condition, $first=false, $filed=['*']);

    /**
     * @param Request $request
     * @return mixed
     */
    public function getListDataTable(Request $request);
}