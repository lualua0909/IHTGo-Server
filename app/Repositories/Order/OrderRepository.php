<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 10:54 PM
 */

namespace App\Repositories\Order;


use App\Helpers\Business;
use App\Models\Order;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderRepository extends EloquentRepository implements OrderRepositoryContract
{

    public function getModel()
    {
        return Order::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function getList(Request $request)
    {
        $conditions = $this->setCondition($request);
        $result = DB::table('orders as o')
            ->select('o.id', 'o.car_type', 'o.car_option', 'o.payment_type', 'o.total_price', 'o.name', 'o.status', 'od.sender_name', 'od.receive_name', 'o.created_at', 'o.code', 'o.is_payment', 'o.user_id')
            ->join('order_details as od', 'o.id', '=', 'od.order_id')
//            ->leftJoin('images as i', function ($join){
//                $join->on('o.id', '=', 'i.service_id')
//                     ->where('i.type', Business::IMAGE_UPLOAD_TYPE_ORDER);
//            })
            //->where('i.type', Business::IMAGE_UPLOAD_TYPE_ORDER)
            ->orderBy($conditions['orderBy']['order_type'], $conditions['orderBy']['order_column'])
            ->where('o.user_id', $conditions['conditions']['user_id']);

        if (array_key_exists('type', $conditions['conditions'])){
            $result->where('o.type', $conditions['conditions']['type']);
            unset($conditions['conditions']['type']);
        }

        if (array_key_exists('status', $conditions['conditions'])){
            $result->where('o.status', $conditions['conditions']['status']);
            unset($conditions['conditions']['status']);
        }

        if (array_key_exists('date', $conditions['conditions'])){
            $start = Carbon::createFromFormat('d/m/Y', $conditions['conditions']['date'])->format('Y-m-d H:i:s');
            $end = Carbon::createFromFormat('Y-m-d H:i:s', $start)->addDay();
            $result->whereBetween('o.created_at', [$start, $end]);
            unset($conditions['conditions']['date']);
        }

        unset($conditions['conditions']['user_id']);
        $result->where(function ($result)use ($conditions) {
            foreach ($conditions['conditions'] as $cond){
                $result = $result->orWhere([$cond]);
            }
        });
        return $result->paginate($conditions['pageSize']);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function setCondition(Request $request)
    {
        $pageSize = $request->pageSize ? $request->pageSize : Business::PAGE_SIZE;
        $keyword = $request->keyword ?  $request->keyword : false;
        if ($keyword) {
            $conditions = [
                ['od.sender_name', 'LIKE', '%' . $keyword . '%'],
                ['od.sender_phone', 'LIKE', '%' . $keyword . '%'],
                ['od.receive_name', 'LIKE', '%' . $keyword . '%'],
                ['od.receive_phone', 'LIKE', '%' . $keyword . '%'],
                ['o.code', 'LIKE', '%' . $keyword . '%'],
            ];
        }

        $date = $request->date ?  $request->date : false;
        if ($date) $conditions['date'] = $date;

        $type = $request->type ? $request->type : false;
        if ($type) $conditions['type'] = $type;

        $status = $request->status ? $request->status : false;
        if ($status) $conditions['status'] = $status;

        $conditions['user_id'] = $request->user()->id;

        return [
            'pageSize' => $pageSize,
            'conditions' => $conditions,
            'orderBy' => [
                'order_column' => $request->sort_order ? $request->sort_order : 'desc',
                'order_type'   => ($request->sort_column == 1) ? 'price' : 'created_at',
            ]
        ];

    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getOrderDataTable(Request $request)
    {
        $condition = $this->setDataFilter($request);

        $result = DB::table('orders as o')
            ->select('o.id', 'o.name', 'o.car_type', 'o.code', 'o.total_price', 'o.created_at', 'u.name as customer', 'u.id as uid', 'o.status', 'o.is_payment')
            ->leftJoin('users as u', 'u.id', '=', 'o.user_id');
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
                    $result->whereDate('o.created_at', Carbon::createFromFormat('d/m/y', $condition['search']['date']['start'])->toDateString());
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
                    $result->whereDate('o.created_at', '>=', $dateMin)
                        ->whereDate('o.created_at', '<=', $dateMax);
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

    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection|mixed
     */
    public function ajaxSelect2(Request $request)
    {
        $keyword = $request->keyword;
        $result = DB::table('orders as o')
            ->join('order_details as od', 'o.id', '=', 'od.order_id')
            ->join('users as u', 'o.user_id', '=', 'u.id')
            ->select('o.id', 'o.name', 'o.code', 'od.sender_name')
            ->orderBy('o.created_at', 'DESC');
        if ($keyword){
            $result->whereRaw("(u.name like'%$keyword%' OR u.phone like'%$keyword%' OR o.code like'%$keyword%' OR od.sender_name like'%$keyword%' OR o.name like'%$keyword%')");
        }
        return $result->take(Business::PAGE_SIZE)->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getMapByOrderId($id)
    {
        $result = DB::table('orders as o')
            ->join('deliveries as dl', 'o.id', '=', 'dl.order_id')
            ->join('drivers as d', 'd.id', '=', 'dl.driver_id')
            ->join('order_details as od', 'dl.order_id', '=', 'od.order_id')
            ->select('d.lat', 'd.lng', 'd.current_address', 'od.sender_address', 'od.receive_address')
            ->find($id);
        return $result;
    }
}