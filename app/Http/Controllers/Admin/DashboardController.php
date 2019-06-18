<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 6/17/18
 * Time: 17:43
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $title = __('label.dashboard');
        $totalOrder = DB::table('orders')->count();
        $totalCar = DB::table('cars')->count();
        $totalDriver = DB::table('drivers')->count();
        $totalCustomer = DB::table('customers')->count();
        $listResult = [];
        return view('admin.dashboard.list', compact('listResult', 'title', 'totalCar', 'totalCustomer', 'totalDriver', 'totalOrder'));
    }
}