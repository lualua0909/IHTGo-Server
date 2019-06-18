<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 25/6/2018
 * Time: 10:17 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\Driver\DriverRepositoryContract;
use App\Repositories\Order\OrderRepositoryContract;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public $driverRepository;

    public $orderRepository;

    public function __construct(DriverRepositoryContract $driverRepositoryContract, OrderRepositoryContract $orderRepositoryContract)
    {
        $this->driverRepository = $driverRepositoryContract;
        $this->orderRepository = $orderRepositoryContract;
    }

    /**
     * @return array
     */
    private function setConfigMaps()
    {
        $config = array();
        $config['zoom'] = '14';
        $config['height'] = 'auto';
        $config['width'] = 'auto';
        $config['directions'] = TRUE;
        $config['directionsDivID'] = 'directionsDiv';
        return $config;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStreet(Request $request)
    {
        $config = $this->setConfigMaps();
        $config['directionsStart'] = 'Hồ Chí Minh City';
        $config['directionsEnd'] = 'Hà Nội City';
        app('map')->initialize($config);

        $marker = array();
        $marker['position'] = 'Đà Nẵng City';
        $marker['infowindow_content'] = 'Đà Nẵng';
        $marker['title'] = 'ThaiLe';
        app('map')->add_marker($marker);

        $map = app('map')->create_map();

        return view('admin.map.street', compact('map'));
    }

    public function postStreet(Request $request)
    {
        $driverId = ($request->driver_id) ? $request->driver_id : null;
        $orderId = ($request->order_id) ? $request->order_id : null;
        $result = null;
        if ($driverId){
            $result = $this->driverRepository->getLastOrderByDriverID($driverId);
        }
        if ($orderId){
            $result = $this->orderRepository->getMapByOrderId($orderId);
        }

        if ($result){
            $config = $this->setConfigMaps();
            $config['directionsStart'] = "$result->sender_address";
            $config['directionsEnd'] = "$result->receive_address";
            app('map')->initialize($config);

            $marker = array();
            $marker['position'] = "$result->lat, $result->lng";
            $marker['infowindow_content'] = "$result->current_address";
            $marker['title'] = "$result->current_address";
            app('map')->add_marker($marker);

            $map = app('map')->create_map();

            return view('admin.map.street', compact('map'));
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.data_error')));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDriver(Request $request)
    {
        $result = $this->driverRepository->getLngLatDriver();
        return view('admin.map.driver', compact('result'));
    }

    public function postDriver(Request $request)
    {
        return 'success';
    }

}