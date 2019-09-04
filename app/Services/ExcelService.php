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
     * @param $orderType
     * @param $listPayer
     * @return mixed
     */
    public function exportDebt($item, $listResult, $start, $end, $orderStatus, $orderType, $listPayer, $orderPayment)
    {
        return Excel::create($item->name . ' - ' . date('dmY'), function($excel) use ($item, $listResult, $start,
            $end, $orderStatus, $orderType, $listPayer, $orderPayment) {
            $excel->sheet('công nợ', function($sheet) use ($item, $listResult, $start, $end, $orderStatus, $orderType, $listPayer, $orderPayment) {
                $sheet->loadView('admin.company.debt', [
                    'listResult' => $listResult,
                    'item' => $item,
                    'start' => $start,
                    'end' => $end,
                    'orderStatus' => $orderStatus,
                    'orderType' => $orderType,
                    'listPayer' => $listPayer,
                    'orderPayment' => $orderPayment
                ]);
                $sheet->setOrientation('landscape');
            });
        })->download('xlsx');
    }

    /**
     * @param $listResult
     * @param $start
     * @param $end
     * @return mixed
     */
    public function exportCompany($listResult, $start, $end)
    {
        return Excel::create($start . '-'  . $end . ') '. '(' . date('dmY') . ')', function($excel) use ($listResult, $start, $end) {
            $excel->sheet('công nợ', function($sheet) use ($listResult, $start, $end) {
                $sheet->loadView('admin.dept.company', [
                    'listResult' => $listResult,
                    'start' => $start,
                    'end' => $end,
                ]);
                $sheet->setOrientation('landscape');
            });
        })->download('xlsx');
    }

    /**
     * @param $listResult
     * @param $start
     * @param $end
     * @param $listPayer
     * @param $orderStatus
     * @param $orderType
     * @param $orderPayment
     * @return mixed
     */
    public function exportStatistic($listResult, $start, $end, $listPayer, $orderStatus, $orderType, $orderPayment)
    {

        return Excel::create($start . '-'  . $end . ') '. '(' . date('dmY') . ')', function($excel) use ($listResult, $start, $end, $listPayer, $orderStatus, $orderType, $orderPayment) {
            $excel->sheet('thong ke', function($sheet) use ($listResult, $start, $end, $listPayer, $orderStatus, $orderType, $orderPayment) {
                $sheet->loadView('admin.statistic.export', [
                    'listResult' => $listResult,
                    'start' => $start,
                    'end' => $end,
                    'listPayer' => $listPayer,
                    'orderStatus' => $orderStatus,
                    'orderType' => $orderType,
                    'orderPayment' => $orderPayment
                ]);
                $sheet->setOrientation('landscape');
            });
        })->download('xlsx');
    }
}