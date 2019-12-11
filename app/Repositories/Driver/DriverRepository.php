<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 2:16 PM
 */

namespace App\Repositories\Driver;


use App\Helpers\Business;
use App\Models\Driver;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverRepository extends EloquentRepository implements DriverRepositoryContract
{
    public function getModel()
    {
       return Driver::class;
    }

    public function getAllWithTrash()
    {
        // TODO: Implement getAllWithTrash() method.
        return $this->_model->withTrashed()->get();
    }

    public function findWithTrash($id)
    {
        // TODO: Implement findWithTrash() method.
        return $this->_model->withTrashed()->find($id);
    }


    /**
     * @param Request $request
     * @param bool $driverId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     */
    public function getHistoryDelivery(Request $request, $driverId = false)
    {
        $status = $request->status ? $request->status : false;
        $pagination = $request->pageSize ? $request->pageSize : 100;
        $driverId = ($driverId) ? $driverId : $request->user()->driver->id;

        $result = DB::table('drivers as dr')
            ->join('deliveries as dl', 'dr.id', '=', 'dl.driver_id')
            ->join('orders as o', 'dl.order_id', '=', 'o.id')
            ->join('users as u', 'o.user_id', '=', 'u.id')
            ->join('order_details as od', 'od.order_id', '=', 'o.id')
            ->orderBy('o.created_at', 'DESC')
            ->select('o.code','o.coupon_code','o.name as order_name', 'o.id', 'o.status', 'o.total_price', 'o.car_type', 'o.car_option', 'dl.created_at', 'u.chatkit_id', 'o.payer', 'od.take_money', 'o.is_speed', 'o.name as oName')
            ->where(['dr.id' => $driverId]);
        if ($status){
            $result->where(['o.status' => $status]);
        }
        if (!$pagination){
            return $result->get();
        }
        return $result->paginate($pagination);
    }

    /**
     * @return mixed|string
     */
    public function getLngLatDriver()
    {
        $result = DB::table('drivers as d')
            ->join('users as u', 'd.user_id', '=', 'u.id')
            ->select('d.id', 'u.name', 'u.phone', 'u.email', 'd.current_address as address', 'd.lat', 'd.lng')
            ->get()
            ->toJson();
        return $result;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function ajaxGetDriver(Request $request)
    {
        $keyword = $request->keyword;
        $result = DB::table('drivers as d')
            ->join('users as u', 'd.user_id', '=', 'u.id')
            ->where(['d.deleted_at' => null])
            ->select('d.id', 'u.name', 'u.phone');
        if ($keyword){
            $result->whereRaw("(u.name like'%$keyword%' OR u.phone like'%$keyword%' OR d.identification like'%$keyword%')");
        }
        return $result->take(Business::PAGE_SIZE)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getLastOrderByDriverID($id)
    {
        $result = DB::table('drivers as d')
            ->join('deliveries as dl', 'd.id', '=', 'dl.driver_id')
            ->join('order_details as od', 'dl.order_id', '=', 'od.order_id')
            ->select('d.lat', 'd.lng', 'd.current_address', 'od.sender_address', 'od.receive_address')
            ->orderBy('dl.created_at', 'DESC')
            ->take(1)
            ->first();
        return $result;
    }

    /**
     * @param array $condition
     * @param bool $first
     * @param array $select
     * @return mixed
     */
    public function findByCondition(array $condition, $first = true, $select = ['*'])
    {
        // TODO: Implement findByCondition() method.
        if ($first){
            return $this->_model->select($select)->where($condition)->first();
        }
        return $this->_model->select($select)->where($condition)->get();
    }

}