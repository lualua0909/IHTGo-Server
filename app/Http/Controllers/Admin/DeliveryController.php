<?php

/**
 * Created by PhpStorm.
 * User: thai
 * Date: 28/6/2018
 * Time: 1:35 PM
 */

namespace App\Http\Controllers\Admin;

use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryRequest;
use App\Models\Car;
use App\Models\Driver;
use App\Models\Order;
use App\Repositories\Delivery\DeliveryRepositoryContract;
use App\Repositories\Driver\DriverRepositoryContract;
use App\Services\DownstreamMessageToDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Expectation;

class DeliveryController extends Controller
{
    /**
     * @var DeliveryRepositoryContract
     */
    public $repository;
    public $streamMessageToDevice;
    /**
     * DeliveryController constructor.
     * @param DeliveryRepositoryContract $repositoryContract
     */
    public function __construct(DeliveryRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
        $this->streamMessageToDevice = new DownstreamMessageToDevice();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $title = __('label.order');
        $orderStatus = array(
            Business::ORDER_STATUS_WAITING => __('label.waiting'),
            Business::ORDER_STATUS_NO_DELIVERY => __('label.no_delivery'),
            Business::ORDER_STATUS_BEING_DELIVERY => __('label.being_delivery'),
            Business::ORDER_STATUS_DONE_DELIVERY => __('label.done_delivery'),
            Business::ORDER_STATUS_CUSTOMER_CANCEL => __('label.customer_cancel'),
            Business::ORDER_STATUS_IHT_CANCEL => __('label.iht_cancel'),
            Business::ORDER_STATUS_FAIL => __('label.order_fail'),
        );
        $orderStatusColor = array(
            Business::ORDER_STATUS_WAITING => 'label-warning',
            Business::ORDER_STATUS_NO_DELIVERY => 'label-primary',
            Business::ORDER_STATUS_BEING_DELIVERY => 'label-info',
            Business::ORDER_STATUS_DONE_DELIVERY => 'label-success',
            Business::ORDER_STATUS_CUSTOMER_CANCEL => 'label-danger',
            Business::ORDER_STATUS_IHT_CANCEL => 'label-danger',
            Business::ORDER_STATUS_FAIL => 'label-danger',
        );
        return view('admin.delivery.list', compact('title', 'orderStatus', 'orderStatusColor'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getListDelivery(Request $request)
    {
        $listDelivery = $this->repository->getDeliveryDataTable($request);
        return $listDelivery;
    }

    public function create(Driver $driver, Car $car)
    {
        $title = __('label.create_delivery');
        $item = false;
        $listDriver = $driver->get();
        $listCar = $car->get();
        return view('admin.delivery.form', compact('title', 'listDriver', 'item', 'listCar'));
    }

    public function createDelivery(DeliveryRequest $request, Order $order)
    {
        $data = [
            'driver_id' => $request->driver_id,
            'car_id' => $request->car_id,
            'user_id' => $request->user()->id,
        ];
        foreach ($request->order as $orderID) {
            $item = $order->find($orderID);
            if ($item && $item->status == Business::ORDER_STATUS_WAITING) {
                $data['order_id'] = $order;
                $this->repository->store($data);
            }
        }
        return redirect(route('delivery.list'))->with($this->messageResponse());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @param Order $order
     */
    public function store(Request $request, Order $order)
    {
        $item = $order->find($request->order_id);
        $data = $request->only('car_id', 'order_id', 'driver_id', 'user_id');
        if ($this->repository->store($data)) {
            return redirect()->back()->with($this->messageResponse());
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param Request $request
     * @param Order $order
     * @param DriverRepositoryContract $driverRepositoryContract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDriver(Request $request, DriverRepositoryContract $driverRepositoryContract, Order $order)
    {
        $item = $order->find($request->order_id);
        $data = $request->only('order_id', 'user_id');

        $driver = $driverRepositoryContract->find($request->id_driver_only);
        if ($driver) {
            $data['driver_id'] = $driver->id;
            if ($this->repository->store($data)) {
                return redirect()->back()->with($this->messageResponse());
            }
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $fcm = Order::findFCMByDelivery($id);
        $customer_fcm = Order::findFCMByDelivery_Customer($id);
        if ($fcm) {
            $deliveries = DB::table('deliveries')->where('id', $id)->first();
            DB::table('orders')->where('id', $deliveries->order_id)->update([
                'status' => 2
            ]);
            DB::table('deliveries')->where('id', $id)->delete();

            $this->streamMessageToDevice->sendMsgToDevice($fcm->fcm, 'Thông báo hủy đơn hàng', 'Có 1 đơn hàng vừa bị hủy', $fcm->order_id, 1);
            $this->streamMessageToDevice->sendMsgToDevice($customer_fcm, 'Thông báo hủy đơn hàng', 'Có 1 đơn hàng vừa bị hủy', $fcm->order_id, 1);
            return redirect()->back()->with($this->messageResponse());
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }

    //raymond
    public function receiverDriver(Request $request, Order $order)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $item = $order->find($request->order_id);

        if ($item && $item->status == Business::ORDER_STATUS_WAITING) {

            $order = DB::table('order_prepare')->where('order_id', $request->order_id)->first();
            if ($order != null && $order->canceled_at == null) {
                DB::table('order_prepare')
                    ->where('order_id', $request->order_id)
                    ->update([
                        'order_id' => $request->order_id,
                        'user_id' => $request->user_id,
                        'driver_id' => (int) $request->id_driver_only,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            } elseif ($order == null || $order->canceled_at != null) {
                DB::table('order_prepare')
                    ->insert([
                        'order_id' => $request->order_id,
                        'user_id' => $request->user_id,
                        'driver_id' => (int) $request->id_driver_only,
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
            }
            DB::table('orders')->where('id', $request->order_id)->update([
                'status' => 2
            ]);

            //gửi thông báo đến cho shipper
            $fcm = Order::findFCMByUserID($request->id_driver_only);
            $this->streamMessageToDevice->sendMsgToDevice($fcm->fcm, 'Thông báo đơn hàng', 'Có 1 đơn hàng vừa được phân công cho bạn', $request->order_id, 1);
            return redirect()->back()->with($this->messageResponse());
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }
    public function cancelReceiverDriver(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $order_prepare = DB::table('order_prepare')
                ->where('id', $request->order_prepare_id)
                ->where('order_id', $request->id)->first();

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            DB::table('order_prepare')
                ->where('id', $request->order_prepare_id)
                ->where('order_id', $request->id)
                ->update([
                    'user_cancel_id' => $user_id,
                    'reason_cancel' => $request->reason,
                    'canceled_at' => date('Y-m-d H:i:s'),
                ]);
            DB::table('orders')->where('id', $request->id)->update([
                'status' => 1
            ]);
            //gửi thông báo đến cho shipper
            $fcm = Order::findFCMByUserID($order_prepare->driver_id);
            $this->streamMessageToDevice->sendMsgToDevice($fcm->fcm, 'Thông báo đơn hàng', 'Có 1 đơn hàng vừa hủy phân công cho bạn', $request->id, 1);
            return redirect()->back()->with($this->messageResponse());
        } catch (Expectation $e) {
            return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
        }
    }
}
