<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 11:37 AM
 */

namespace App\Repositories\Evaluate;


use Illuminate\Http\Request;

interface EvaluateRepositoryContract
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function getCustomerDataTable(Request $request);
}