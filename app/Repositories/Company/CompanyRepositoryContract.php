<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 1:01 PM
 */

namespace App\Repositories\Company;


use Illuminate\Http\Request;

interface CompanyRepositoryContract
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getDataTable(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function getCompanyForApi(Request $request);

    /**
     * @param array $condition
     * @param bool $first
     * @param array $select
     * @return mixed
     */
    public function findByCondition(array $condition, $first = true, $select = ['*']);

    /**
     * @param $id
     * @param $start
     * @param $end
     * @return mixed
     */
    public function getDebt($id, $start, $end);
}