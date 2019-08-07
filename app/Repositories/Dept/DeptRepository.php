<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 1:01 PM
 */

namespace App\Repositories\Dept;


use App\Helpers\Business;
use App\Models\Dept;
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
        return Dept::class;
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

        return [
            'start' => $start,
            'limit' => $limit,
            'order' => [
                'column' => $order,
                'dir' => $order_dir]
            ,
        ];
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getDeptDataTable(Request $request)
    {
        $condition = $this->setDataFilter($request);

        $result = DB::table('depts as d')
            ->select('c.name', 'd.from', 'd.to', 'd.id', 'd.money')
            ->leftJoin('companies as c', 'c.id', '=', 'd.company_id');
        if ($condition['order']['column']){
            $result->orderBy($condition['order']['column'], $condition['order']['dir']);
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
     * @param $from
     * @param $to
     * @return \Illuminate\Support\Collection
     */
    public function findDataExport($from, $to)
    {
        // TODO: Implement findDataExport() method.
        $result = DB::table('depts as d')
            ->leftJoin('companies as c', 'd.company_id', '=', 'c.id')
            ->leftJoin('districts as di', 'c.district_id', '=', 'di.id')
            ->leftJoin('provinces as p', 'c.province_id', '=', 'p.province_id')
            ->select(['c.name', 'c.address', 'di.name as district', 'p.name as province', 'd.money'])
            ->whereDate('d.from', $from)
            ->whereDate('d.to', $to)
            ->distinct('c.id')
            ->get();
        return $result;
    }


}