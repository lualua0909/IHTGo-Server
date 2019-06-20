<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 1:01 PM
 */

namespace App\Repositories\CollectionOfDebt;


use App\Helpers\Business;
use App\Models\CollectionOfDebt;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionOfDebtRepository extends EloquentRepository implements CollectionOfDebtRepositoryContract
{
    /**
     * @return string
     */
    public function getModel()
    {
        return CollectionOfDebt::class;
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
        $search['name'] = isset($request->name) ? $request->name : '';
        $search['employee'] = isset($request->employee) ? $request->employee : '';

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

        $result = DB::table('collection_of_debts as c')
            ->select('c.name', 'u.name as user', 'e.name as employee', 'c.id', 'c.created_at', 'c.status', 'c.money')
            ->leftJoin('users as u', 'u.id', '=', 'c.user_id')
            ->leftJoin('users as e', 'e.id', '=', 'c.employee_id');
        if ($condition['order']['column']){
            $result->orderBy($condition['order']['column'], $condition['order']['dir']);
        }
        if($condition['search'] && is_array($condition['search'])){
            if(!empty($condition['search']['name'])){
                $keySearch = $condition['search']['name'];
                $result->whereRaw("(c.name like'%$keySearch%')");
            }

            if(!empty($condition['search']['employee'])){
                $employee = $condition['search']['employee'];
                $result->whereRaw("(e.name like'%$employee%')");
            }

            if(!empty($condition['search']['status'])){
                $status = $condition['search']['status'];
                $result->whereStatus($status);
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

    public function findByCondition(array $condition, $first = true, $select = ['*'])
    {
        // TODO: Implement findByCondition() method.
        if ($first){
            return $this->_model->select($select)->where($condition)->first();
        }
        return $this->_model->select($select)->where($condition)->get();
    }


}