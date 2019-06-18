<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 7/17/18
 * Time: 10:04
 */

namespace App\Repositories\Finance;


use App\Helpers\Business;
use App\Models\Finance;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceRepository extends EloquentRepository implements FinanceRepositoryContract
{
    /**
     * @return string
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Finance::class;
    }

    /**
     * @param array $condition
     * @param bool $first
     * @param array $filed
     * @return mixed
     */
    public function getByCondition(array $condition, $first = true, $filed = ['*'])
    {
        // TODO: Implement getByCondition() method.
        if($first){
            return $this->_model->select($filed)->where($condition)->first();
        }
        return $this->_model->select($filed)->where($condition)->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getListDataTable(Request $request)
    {
        $condition = $this->setDataFilter($request);

        $result = DB::table('finances as f')
            ->select('f.id', 'f.name', 'f.type', 'f.total', 'f.created_at', 'u.name as employee', 'u.id as uid', 'f.date')
            ->leftJoin('users as u', 'u.id', '=', 'f.user_id');
        if ($condition['order']['column']){
            $result->orderBy($condition['order']['column'], $condition['order']['dir']);
        }
        if($condition['search'] && is_array($condition['search'])) {

            if (!empty($condition['search']['type'])) {
                $result->where('f.type', $condition['search']['type']);
            }

            if (!empty($condition['search']['date']['start']) && !empty($condition['search']['date']['end'])) {
                if ($condition['search']['date']['start'] == $condition['search']['date']['end']) {
                    $result->whereDate('f.created_at', Carbon::createFromFormat('d/m/y', $condition['search']['date']['start'])->toDateString());
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
                    $result->whereDate('f.created_at', '>=', $dateMin)
                        ->whereDate('f.created_at', '<=', $dateMax);
                }
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
        $search['date'] = [
            'start' => $request->startDate,
            'end' => $request->endDate
        ];
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

}