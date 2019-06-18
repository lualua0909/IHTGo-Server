<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 2:14 PM
 */

namespace App\Repositories\Delivery;


use App\Helpers\Business;
use App\Models\Delivery;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryRepository extends EloquentRepository implements DeliveryRepositoryContract
{

    public function getModel()
    {
        return Delivery::class;
    }

    public function getDeliveryDataTable(Request $request)
    {
        $condition = $this->setDataFilter($request);

        $result = DB::table('deliveries as d')
            ->select('d.order_id', 'u.name as driver', 'd.driver_id', 'c.name as cName', 'o.status', 'o.code', 'uc.name as customer', 'd.created_at', 'd.id')
            ->leftJoin('drivers as dr', 'dr.id', '=', 'd.driver_id')
            ->leftJoin('users as u', 'u.id', '=', 'dr.user_id')
            ->leftJoin('cars as c', 'c.id', '=', 'd.car_id')
            ->leftJoin('orders as o', 'o.id', '=', 'd.order_id')
            ->leftJoin('users as uc', 'uc.id', '=', 'o.user_id');
        if ($condition['order']['column']){
            $result->orderBy($condition['order']['column'], $condition['order']['dir']);
        }
        if($condition['search'] && is_array($condition['search'])) {
            if (!empty($condition['search']['status'])) {
                $result->where('o.status', $condition['search']['status']);
            }

            if (!empty($condition['search']['car_type'])) {
                $result->where('o.car_type', $condition['search']['car_type']);
            }

            if (array_key_exists('payment', $condition['search'])) {
                $result->where('o.is_payment', $condition['search']['payment']);
            }

            if (!empty($condition['search']['date']['start']) && !empty($condition['search']['date']['end'])) {
                if ($condition['search']['date']['start'] == $condition['search']['date']['end']) {
                    $result->whereDate('d.created_at', Carbon::createFromFormat('d/m/y', $condition['search']['date']['start'])->toDateString());
                } else {
                    $dateMin = Carbon::createFromFormat('d/m/y', $condition['search']['date']['start'])->toDateString();
                    $dateMax = Carbon::createFromFormat('d/m/y', $condition['search']['date']['end'])->toDateString();
                    if ($dateMin > $dateMax) {
                        $search['date']['start'] = $dateMax;
                        $search['date']['end'] = $dateMin;
                    } else {
                        $search['date']['start'] = $dateMin;
                        $search['date']['end'] = $dateMax;
                    }
                    $result->whereDate('d.created_at', '>=', $dateMin)
                        ->whereDate('d.created_at', '<=', $dateMax);
                }
            }
            if (!empty($condition['search']['keyword'])) {
                $keySearch = $condition['search']['keyword'];
                $result->whereRaw("(u.name like'%$keySearch%' OR u.phone like'%$keySearch%' OR o.name like'%$keySearch%' OR o.code like'%$keySearch%')");
            }
        }
        $data['recordsTotal'] = $data['recordsFiltered'] = $result->count();
        if($condition['start'] == -1 && $condition['limit'] == -1){
            $result = $result->get()->toArray();
        } else {
            $result = $result->offset($condition['start'])->limit($condition['limit'])->get()->toArray();
        }
        $data['data'] = $result;
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function setDataFilter(Request $request)
    {
        $start = isset($request->start) ? $request->start : 0;
        $limit = isset($request->length) ? $request->length : Business::PAGE_SIZE;
        $order = isset($request['order'][0]['column']) && isset($request['columns'][$request['order'][0]['column']]['data']) ? $request['columns'][$request['order'][0]['column']]['data'] : '';
        $order_dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : '';
        $type = isset($request->type) ? $request->type : '';
        $payment = isset($request->payment) ? $request->payment : null;
        $status = isset($request->status) ? $request->status : '';
        $search['keyword'] = isset($request->keyword) ? $request->keyword : '';
        $search['date'] = [
            'start' => $request->startDate,
            'end' => $request->endDate
        ];
        if(!is_null($type)){
            $search['car_type'] = $type;
        }
        if(!is_null($status)){
            $search['status'] = $status;
        }
        if(!is_null($payment)){
            $search['payment'] = $payment;
        }
        return [
            'start' => $start,
            'limit' => $limit,
            'order' => [
                'column' => $order,
                'dir' => $order_dir
            ],
            'search' => $search
        ];
    }
}