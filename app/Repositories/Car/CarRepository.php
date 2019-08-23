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
use Illuminate\Http\Request;
use App\Helpers\Business;

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
            $result->delete();
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
            ->select('o.code','o.coupon_code','o.name as order_name', 'o.id', 'dr.id as dId', 'u.name', 'u.phone', 'o.status', 'o.total_price',  'dl.created_at')
            ->where(['c.id' => $id])
            ->get();
        return $result;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function ajaxGetCar(Request $request)
    {
        $keyword = $request->searchtext;
        $result = DB::table('cars')
            ->where(['deleted_at' => null])
            ->select('id', 'name', 'number');
        if ($keyword){
            $result->whereRaw("(name like'%$keyword%' OR weight like'%$keyword%' OR number like'%$keyword%')");
        }
        return $result->take(Business::PAGE_SIZE)->get();
    }
}