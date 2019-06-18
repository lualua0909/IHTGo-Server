<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 1:01 PM
 */

namespace App\Repositories\Dept;


use App\Helpers\Business;
use App\Models\Customer;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeptRepository extends EloquentRepository implements DeptRepositoryContract
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
        $search['type'] = isset($request->type) ? $request->type : Business::CUSTOMER_TYPE_COMPANY;
        $search['date'] = isset($request->date) ? Carbon::createFromFormat('m/Y', $request->date)->format('Y-m') : date('Y-m');

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
    public function getDeptDataTable(Request $request)
    {
        $condition = $this->setDataFilter($request);

        $result = DB::table('customers as c')
            ->select('u.email', 'u.name', 'u.phone', 'c.id')
            ->leftJoin('users as u', 'u.id', '=', 'c.user_id')
            ->leftJoin('orders as o', 'o.user_id', '=', 'c.user_id')
            ->where('o.is_payment', Business::PAYMENT_DEPT)
            ->distinct('c.id');
        if ($condition['order']['column']){
            $result->orderBy($condition['order']['column'], $condition['order']['dir']);
        }
        if($condition['search'] && is_array($condition['search'])){
            if(!empty($condition['search']['type'])){
                $result->where('c.type', $condition['search']['type']);
            }

            if(!empty($condition['search']['date'])){
                $start = Carbon::createFromFormat('Y-m', $condition['search']['date'])->startOfMonth();
                $end = Carbon::createFromFormat('Y-m', $condition['search']['date'])->endOfMonth();
                $result->whereBetween('o.created_at', [$start, $end]);
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
}