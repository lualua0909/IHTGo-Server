<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 1:01 PM
 */

namespace App\Repositories\Dept;


use Illuminate\Http\Request;

interface DeptRepositoryContract
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getDeptDataTable(Request $request);

    public function findDataExport($from, $to);
}