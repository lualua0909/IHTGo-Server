<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 7/16/18
 * Time: 09:31
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $title = 'test';
        $date = false;
        $dateNow = date('d/m/Y') . ' - ' . date('d/m/Y');
        $order = $this->getOrder($dateNow)[0];
        $finance = $this->getFinance($dateNow)[0];
        return view('admin.statistic.statistic', compact('title', 'order', 'finance', 'date'));
    }

    public function statistic(Request $request)
    {
        $title = 'test';
        $date = $request->date;
        $order = $this->getOrder($date)[0];
        $finance = $this->getFinance($date)[0];
        return view('admin.statistic.statistic', compact('title', 'date', 'order', 'finance'));
    }

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
}