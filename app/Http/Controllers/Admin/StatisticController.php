<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 7/16/18
 * Time: 09:31
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Services\ExcelService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = __('label.statistic');
        $date = false;
        $dateNow = date('d/m/Y') . ' - ' . date('d/m/Y');
        $order = $this->getOrder($dateNow)[0];
        $finance = $this->getFinance($dateNow)[0];
        return view('admin.statistic.statistic', compact('title', 'order', 'finance', 'date'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function statistic(Request $request)
    {
        $title = __('label.statistic');
        $date = $request->date;
        $order = $this->getOrder($date)[0];
        $finance = $this->getFinance($date)[0];
        return view('admin.statistic.statistic', compact('title', 'date', 'order', 'finance'));
    }

    /**
     * @param $date
     * @return \Illuminate\Support\Collection
     */
    private function getOrder($date)
    {
        $arrDate = explode(' - ', $date);
        $start = Carbon::createFromFormat('d/m/Y', $arrDate[0])->startOfDay()->format('Y-m-d H:i:s');
        $end = Carbon::createFromFormat('d/m/Y', $arrDate[1])->endOfDay()->format('Y-m-d H:i:s');
        $listOrder = DB::table('orders')
            ->selectRaw('COUNT(CASE WHEN status = 1 THEN 1 END) as waiting,
                                    COUNT(CASE WHEN status = 2 THEN 1 END) as no_delivery, 
                                    COUNT(CASE WHEN status = 3 THEN 1 END) as being_delivery,
                                    COUNT(CASE WHEN status = 4 THEN 1 END) as done_delivery, 
                                    COUNT(CASE WHEN status = 5 THEN 1 END) as customer_cancel,
                                    COUNT(CASE WHEN status = 6 THEN 1 END) as iht_cancel')
            ->whereBetween('created_at', [$start, $end])
            ->get();
        return $listOrder;
    }

    /**
     * @param $date
     * @return \Illuminate\Support\Collection
     */
    private function getFinance($date)
    {
        $arrDate = explode(' - ', $date);
        $start = Carbon::createFromFormat('d/m/Y', $arrDate[0])->startOfDay()->format('Y-m-d');
        $end = Carbon::createFromFormat('d/m/Y', $arrDate[1])->endOfDay()->format('Y-m-d');
        $listFinance = DB::table('finances')
            ->selectRaw('SUM(CASE WHEN type = 1 THEN total END) as finance_in,
                                    SUM(CASE WHEN type = 2 THEN total END) as finance_out')
            ->whereBetween('date', [$start, $end])
            ->get();
        return $listFinance;
    }

    public function export(Request $request, ExcelService $excelService)
    {
        $date = $request->date;
        $listPayer = [
            Business::PAYER_RECEIVE => __('label.payer_receive'),
            Business::PAYER_SENDER => __('label.payer_sender'),
        ];
        $orderStatus = array(
            Business::ORDER_STATUS_WAITING => __('label.waiting'),
            Business::ORDER_STATUS_NO_DELIVERY => __('label.no_delivery'),
            Business::ORDER_STATUS_BEING_DELIVERY => __('label.being_delivery'),
            Business::ORDER_STATUS_DONE_DELIVERY => __('label.done_delivery'),
            Business::ORDER_STATUS_CUSTOMER_CANCEL => __('label.customer_cancel'),
            Business::ORDER_STATUS_IHT_CANCEL => __('label.iht_cancel'),
            Business::ORDER_STATUS_FAIL => __('label.iht_failed'),
        );
        $listType = [
            Business::PRICE_BY_TH1 => __('label.th1'),
            Business::PRICE_BY_TH2 => __('label.th2'),
            Business::PRICE_BY_TH3 => __('label.th3'),
        ];
        $orderPayment = array(
            Business::PAYMENT_DONE => __('label.payment_done'),
            Business::PAYMENT_DEPT => __('label.payment_dept')
        );
        $arrDate = explode(' - ', $date);
        $start = Carbon::createFromFormat('d/m/Y', $arrDate[0])->startOfDay()->format('Y-m-d H:i:s');
        $end = Carbon::createFromFormat('d/m/Y', $arrDate[1])->endOfDay()->format('Y-m-d H:i:s');
        return $excelService->exportStatistic($this->exportByDate($start . ' 00:00:00', $end . ' 23:59:59'), $start, $end, $listPayer, $orderStatus, $listType, $orderPayment);

    }

    private function exportByDate($start, $end)
    {
        $result = DB::table('customers as c')
            ->leftJoin('companies as co', 'co.id', '=', 'c.company_id')
            ->leftJoin('users as cu', 'cu.id', '=', 'c.user_id')
            ->leftJoin('orders as o', 'cu.id', '=', 'o.user_id')
            ->leftJoin('deliveries as d', 'o.id', '=', 'd.order_id')
            ->leftJoin('drivers as dr', 'dr.id', '=', 'd.driver_id')
            ->leftJoin('warehouses as w', 'w.id', '=', 'dr.warehouse_id')
            ->leftJoin('users as du', 'du.id', '=', 'dr.user_id')
            ->leftJoin('users as wu', 'wu.id', '=', 'w.manager_id')
            ->leftJoin('order_details as od', 'od.order_id', '=', 'o.id')
            ->leftJoin('provinces as ps', 'ps.province_id', '=', 'od.sender_province_id')
            ->leftJoin('provinces as pr', 'pr.province_id', '=', 'od.receive_province_id')
            ->leftJoin('districts as ds', 'ds.id', '=', 'od.sender_district_id')
            ->leftJoin('districts as drr', 'drr.id', '=', 'od.receive_province_id')
            ->select('w.code as npp_code', 'wu.name as npp_name', 'du.code as nvgh_code', 'du.name as nvgh_name', 'c.code as customer_code', 'cu.name as customer_name', 'c.address', 'o.status', 'o.code', 'o.total_price', 'o.created_at as sender_date', 'o.car_option', 'o.payer', 'd.created_at as delivery_date', 'ps.name as sender_province', 'ds.name as sender_district', 'pr.name as receive_province', 'drr.name as receive_district', 'od.sender_address', 'od.receive_address', 'od.note', 'od.take_money', 'co.name as coName', 'c.company_id', 'o.is_payment', 'od.sender_name', 'o.name as order_name')
            ->whereBetween('o.created_at', [$start, $end])
            ->get();
        return $result;
    }
}