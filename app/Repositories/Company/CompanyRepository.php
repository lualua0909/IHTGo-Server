<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 1:01 PM
 */

namespace App\Repositories\Company;


use App\Helpers\Business;
use App\Models\Company;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class CompanyRepository extends EloquentRepository implements CompanyRepositoryContract
{
    /**
     * @return string
     */
    public function getModel()
    {
        return Company::class;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function setDataFilter(Request $request)
    {
        $start = isset($request->start) ? $request->start : 0;
        $limit = isset($request->length) ? $request->length : Business::PAGE_SIZE;
        $order = isset($request['order'][0]['column']) && isset($request['columns'][$request['order'][0]['column']]['data'])
            ? $request['columns'][$request['order'][0]['column']]['data'] : '';
        $order_dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : '';
        $search['name'] = isset($request->name) ? $request->name : '';
        $search['address'] = isset($request->address) ? $request->address : '';
        $search['phone'] = isset($request->phone) ? $request->phone : '';
        $search['tax'] = isset($request->tax) ? $request->tax : '';

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
    public function getDataTable(Request $request)
    {
        $condition = $this->setDataFilter($request);

        $result = DB::table('companies as c')
            ->select('c.name', 'u.name as employee', 'c.id', 'c.created_at', 'c.address', 'c.phone', 'c.tax')
            ->leftJoin('users as u', 'u.id', '=', 'c.user_id')
            ->where('c.publish', Business::PUBLISH);
        if ($condition['order']['column']){
            $result->orderBy($condition['order']['column'], $condition['order']['dir']);
        }
        if($condition['search'] && is_array($condition['search'])){
            if(!empty($condition['search']['name'])){
                $keySearch = $condition['search']['name'];
                $result->whereRaw("(c.name like'%$keySearch%')");
            }

            if(!empty($condition['search']['address'])){
                $address = $condition['search']['address'];
                $result->whereRaw("(c.address like'%$address%')");
            }

            if(!empty($condition['search']['phone'])){
                $phone = $condition['search']['phoe'];
                $result->whereRaw("(c.phone like'%$phone%')");
            }

            if(!empty($condition['search']['tax'])){
                $tax = $condition['search']['tax'];
                $result->whereRaw("(c.address like'%$tax%')");
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

    public function getCompanyForApi(Request $request)
    {
        // TODO: Implement getCompanyForApi() method.
        $result = DB::table('companies as c')
            ->select('c.name', 'c.id', 'c.address', 'c.phone')
            ->where('c.publish', Business::PUBLISH);

        if($request->name){
            $result->whereRaw("(c.name like'%$request->name%')");
        }

        if($request->phone){
            $result->whereRaw("(c.phone like'%$request->phone%')");
        }
        return $result->get();
    }

    /**
     * @param array $condition
     * @param bool $first
     * @param array $select
     * @return mixed
     */
    public function findByCondition(array $condition, $first = true, $select = ['*'])
    {
        if ($first){
            return $this->_model->select($select)->where($condition)->first();
        }
        return $this->_model->select($select)->where($condition)->get();
    }

    public function getDebt($id, $start, $end)
    {
        $result = DB::table('customers as c')
            ->leftJoin('users as cu', 'cu.id', '=', 'c.user_id')
            ->leftJoin('orders as o', 'cu.id', '=', 'o.user_id')
            ->leftJoin('deliveries as d', 'o.id', '=', 'd.order_id')
            ->leftJoin('drivers as dr', 'dr.id', '=', 'd.driver_id')
            ->leftJoin('warehouses as w', 'w.id', '=', 'dr.warehouse_id')
            ->leftJoin('users as du', 'du.id', '=', 'dr.user_id')
            ->leftJoin('users as wu', 'wu.id', '=', 'w.manager_id')
            ->leftJoin('order_details as od', 'od.order_id', '=', 'o.id')
            ->select('w.code as npp_code', 'wu.name as npp_name',
            'du.code as nvgh_code', 'du.name as nvgh_name', 
            'c.code as customer_code', 'cu.name as customer_name', 'c.address',
            'o.status', 'o.code','o.coupon_code', 'o.total_price', 'o.created_at as sender_date', 'o.car_option', 'o.payer', 'o.name as order_name','o.is_payment', 
            'd.created_at as delivery_date', 
            'od.sender_name', 'od.sender_phone','od.sender_address','od.receive_name', 'od.receive_phone', 'od.receive_address', 'od.note', 'od.admin_note', 'od.take_money')
            ->whereBetween('o.created_at', [$start, $end])
            ->where(['c.company_id' => $id])
            ->get();
        return $result;
    }
}