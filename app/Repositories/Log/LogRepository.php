<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/4/18
 * Time: 22:10
 */

namespace App\Repositories\Log;


use App\Helpers\Business;
use App\Models\Logs;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogRepository extends EloquentRepository implements LogRepositoryContact
{
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Logs::class;
    }

    /**
     * @param Request $request
     * @return array
     */
    private function setDataFilter(Request $request)
    {
        $start = isset($request->start) ? $request->start : 0;
        $limit = isset($request->length) ? $request->length : Business::PAGE_SIZE;
        $order = isset($request['order'][0]['column']) && isset($request['columns'][$request['order'][0]['column']]['data']) ? $request['columns'][$request['order'][0]['column']]['data'] : 'id';
        $order_dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $search['date'] = isset($request->date) ? $request->date : date('d/m/Y');

        return [
            'start' => $start,
            'limit' => $limit,
            'order' => [
                'column' => $order,
                'dir' => $order_dir
            ]
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
        
        $result = DB::table('logs as l')
            ->select('l.content', 'l.created')
            ->orderBy('id', 'DESC');
        if ($condition['order']['column']){
            $result->orderBy($condition['order']['column'], $condition['order']['dir']);
        }
        if($condition['search'] && is_array($condition['search'])){
            if(!empty($condition['search']['date'])){
                $start = Carbon::createFromFormat('d/m/Y', $condition['search']['date'])->format('Y-m-d');
                $result->whereDate('created', $start);
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