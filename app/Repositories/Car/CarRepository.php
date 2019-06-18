<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 2:04 PM
 */

namespace App\Repositories\Car;


use App\Models\Car;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\DB;

class CarRepository extends EloquentRepository implements CarRepositoryContract
{

    public function getModel()
    {
        return Car::class;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if($result) {
            $result->softDeletes();
            return true;
        }

        return false;
    }

    /**
     * @return \Illuminate\Support\Collection|mixed
     */
    public function getHistoryDelivery($id)
    {
        $result = DB::table('drivers as dr')
            ->leftJoin('deliveries as dl', 'dr.id', '=', 'dl.driver_id')
            ->leftJoin('orders as o', 'dl.order_id', '=', 'o.id')
            ->leftJoin('cars as c', 'dl.car_id', '=', 'c.id')
            ->leftJoin('users as u', 'dr.user_id', '=', 'u.id')
            ->select('o.code', 'o.id', 'dr.id as dId', 'u.name', 'u.phone', 'o.status', 'o.total_price', 'o.type', 'dl.created_at')
            ->where(['c.id' => $id])
            ->get();
        return $result;
    }
}