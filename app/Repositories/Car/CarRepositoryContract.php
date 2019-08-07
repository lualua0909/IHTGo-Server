<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 2:03 PM
 */

namespace App\Repositories\Car;

use Illuminate\Http\Request; 
interface CarRepositoryContract
{
    /**
     * @return mixed
     */
    public function getHistoryDelivery($id);

    /**
     * @param Request $request
     * @return mixed
     */
    public function ajaxGetCar(Request $request);
}