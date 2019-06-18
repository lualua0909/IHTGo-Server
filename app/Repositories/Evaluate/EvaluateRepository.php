<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 11:37 AM
 */

namespace App\Repositories\Evaluate;


use App\Helpers\Business;
use App\Models\Evaluate;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluateRepository extends EloquentRepository implements EvaluateRepositoryContract
{
    public function getModel()
    {
        return Evaluate::class;
    }

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
                'dir' => $order_dir
            ],
            'search' => $search
        ];
    }

    public function getCustomerDataTable(Request $request)
    {
        $condition = $this->setDataFilter($request);

        $result = DB::table('evaluates as e')
            ->select('e.id', 'e.type', 'from.name as from_name', 'to.name as to_name', 'e.created_at')
            ->leftJoin('users as from', 'from.id', '=', 'e.from_id')
            ->join('users as to', 'to.id', '=', 'e.to_id');
        if ($condition['order']['column']){
            $result->orderBy($condition['order']['column'], $condition['order']['dir']);
        }
        if($condition['search'] && is_array($condition['search'])){
            if(!empty($condition['search']['type'])){
                $result->where('e.type', $condition['search']['type']);
            }

            if(!empty($condition['search']['keyword'])){
                $keySearch = $condition['search']['keyword'];
                $result->whereRaw("(to.name like'%$keySearch%' OR from.name like'%$keySearch%')");
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