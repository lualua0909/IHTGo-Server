<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 11/7/2018
 * Time: 3:34 PM
 */

namespace App\Services;


use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ExcelService
 * @package App\Services
 */
class ExcelService
{
    /**
     * @param $item
     * @param $listResult
     * @param $start
     * @param $end
     * @param $orderStatus
     * @return mixed
     */
    public function exportDebt($item, $listResult, $start, $end, $orderStatus)
    {
        return Excel::create($item->user->name . ' ('  . $item->code . ') '. '-' . date('dmY'), function($excel) use ($item, $listResult, $start, $end, $orderStatus) {
            $excel->sheet('công nợ', function($sheet) use ($item, $listResult, $start, $end, $orderStatus) {
                $sheet->loadView('admin.customer.debt', [
                    'listResult' => $listResult,
                    'item' => $item,
                    'start' => $start,
                    'end' => $end,
                    'orderStatus' => $orderStatus
                ]);
                $sheet->setOrientation('landscape');
            });
        })->download('xls');
    }
}