<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 1:01 PM
 */

namespace App\Repositories\Customer;


use App\Helpers\Business;
use App\Models\Customer;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerRepository extends EloquentRepository implements CustomerRepositoryContract
{
    /**
     * @return string
     */
    public function getModel()
    {
        return Customer::class;
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
        $search['keyword'] = isset($request->keyword) ? $request->keyword : '';
        if(!is_null($type)){
            $search['type'] = $type;
        }
        return [
            'start' => $start,
            'limit' => $limit,
            'order' => [
                'column' => $order,
                'dir' => $order_dir]
            ,
            'search' => $search
        ];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getCustomerDataTable(Request $request)
    {
        $condition = $this->setDataFilter($request);

        $result = DB::table('customers as c')
            ->select('u.email', 'u.name', 'u.phone', 'c.type', 'c.address', 'c.created_at', 'c.id', 'u.chatkit_id')
            ->leftJoin('users as u', 'u.id', '=', 'c.user_id');
        if ($condition['order']['column']){
            $result->orderBy($condition['order']['column'], $condition['order']['dir']);
        }
        if($condition['search'] && is_array($condition['search'])){
            if(!empty($condition['search']['type'])){
                $result->where('c.type', $condition['search']['type']);
            }

            if(!empty($condition['search']['keyword'])){
                $keySearch = $condition['search']['keyword'];
                $result->whereRaw("(u.name like'%$keySearch%' OR u.email like'%$keySearch%' OR u.phone like'%$keySearch%')");
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

    public function getDebtCustomer($id, $start, $end)
    {
        $result = DB::table('customers as c')
            ->join('orders as o', 'c.id', '=', 'o.user_id')
            ->join('deliveries as d', 'o.id', '=', 'd.order_id')
            ->join('drivers as dr', 'dr.id', '=', 'd.driver_id')
            ->join('warehouses as w', 'w.id', '=', 'dr.warehouse_id')
            ->join('users as du', 'du.id', '=', 'dr.user_id')
            ->join('users as wu', 'wu.id', '=', 'w.manager_id')
            ->join('users as cu', 'cu.id', '=', 'c.user_id')
            ->select('w.code as npp_code', 'wu.name as npp_name', 'du.code as nvgh_code', 'du.name as nvgh_name',
                'c.code as customer_code', 'cu.name as customer_name', 'c.address', 'o.created_at', 'o.status', 'o.code', 'o.total_price')
            ->whereBetween('o.created_at', [$start, $end])
            //->where('o.status', Business::ORDER_STATUS_DONE_DELIVERY)
            ->get();
        return $result;
    }

    public function ajaxSelect2(Request $request)
    {
        $keyword = $request->keyword;
        $result = DB::table('users as u')
            ->select('u.id', 'u.name', 'u.phone')
            ->where(['u.level' => Business::USER_LEVEL_CUSTOMER]);
        if ($keyword){
            $result->whereRaw("(u.name like'%$keyword%' OR u.phone like'%$keyword%')");
        }
        return $result->take(Business::PAGE_SIZE)->get();
    }
}