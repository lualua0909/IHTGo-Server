<?php

/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 10:57 PM
 */

namespace App\Http\Controllers\Admin;

use App\Helpers\Business;
use App\Helpers\HttpCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Data\District;
use App\Models\Data\Other;
use App\Models\Data\Province;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Warehouse;
use App\Repositories\OrderDetail\OrderDetailRepositoryContract;
use App\Repositories\Order\OrderRepositoryContract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @var OrderRepositoryContract
     */
    public $repository;

    /**
     * OrderController constructor.
     * @param OrderRepositoryContract $repositoryContract
     */
    public function __construct(OrderRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        return redirect('admin/order/list-new');
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

        $listCar = Other::select('id', 'name')->where(['type' => Business::OTHER_TYPE_CAR])->get();
        $orderType = $this->convertObjectToArray($listCar);

        $orderPayment = array(
            Business::ORDER_STATUS_PAYMENT => __('label.payment_yes'),
            Business::ORDER_STATUS_NO_PAYMENT => __('label.payment_no'),
            Business::PAYMENT_DEPT => __('label.payment_dept'),
        );
        $orderPaymentColor = array(
            Business::ORDER_STATUS_PAYMENT => 'label-success',
            Business::ORDER_STATUS_NO_PAYMENT => 'label-danger',
            Business::PAYMENT_DEPT => 'label-primary',
        );

        return view('admin.order.list', compact(
            'orderType',
            'title',
            'orderStatus',
            'orderStatusColor',
            'orderPayment',
            'orderPaymentColor'
        ));
    }

    public function getListNew()
    {
        $date = '';
        $search = '';
        $status = '';
        $car_option = '';
        $orders = Order::getListNew();
        return view('admin.order.list2', compact('orders', 'date', 'search', 'status', 'car_option'));
    }
    //search theo trang thai & phuong thuc thanh toan, ngay
    public function getOptionListNew(Request $req)
    {
        $date = $req->session()->get('search-date', '');
        $search = '';
        $status = $req->session()->get('search-status', '');
        $car_option = $req->session()->get('search-car_option', '');
        $orders = Order::postOptionListNew($status, $car_option, $date);
        return view('admin.order.list2', compact('orders', 'date', 'search', 'status', 'car_option'));
    }
    public function postOptionListNew(Request $req)
    {
        $date = $req->date;
        $search = '';
        $status = $req->status;
        $car_option = $req->car_option;
        $orders = Order::postOptionListNew($req->status, $req->car_option, $req->date);
        $req->session()->put('search-status', $req->status);
        $req->session()->put('search-car_option', $req->car_option);
        $req->session()->put('search-date', $req->date);
        return view('admin.order.list2', compact('orders', 'date', 'search', 'status', 'car_option'));
    }
    //search theo ten kh, ten don hang, coupon_code, sdt
    public function getSearchListNew(Request $req)
    {
        $date = '';
        $search = $req->session()->get('search-text', '');
        $status = '';
        $car_option = '';
        $orders = Order::postSearchListNew($req->session()->get('search-text', ''));
        return view('admin.order.list2', compact('orders', 'date', 'search', 'status', 'car_option'));
    }
    public function postSearchListNew(Request $req)
    {
        $date = '';
        $search = $req->search;
        $status = '';
        $car_option = '';
        $orders = Order::postSearchListNew($req->search);
        $req->session()->put('search-text', $req->search);
        return view('admin.order.list2', compact('orders', 'date', 'search', 'status', 'car_option'));
    }
    /**
     * @param $objectCar
     * @return array
     */
    private function convertObjectToArray($objectCar)
    {
        $result = [];
        foreach ($objectCar as $car) {
            $result[$car->id] = $car->name;
        }
        return $result;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getListOrder(Request $request)
    {
        $listCustomer = $this->repository->getOrderDataTable($request);
        return $listCustomer;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $item = $this->repository->find($id);
        if (!$item) {
            return abort(404);
        }

        try {
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

            $listSpeed = [
                Business::ORDER_SPEED => __('label.speed'),
                Business::ORDER_UN_SPEED => __('label.un_speed'),
            ];

            $listCar = Other::where(['type' => Business::OTHER_TYPE_CAR])->get(['id', 'name']);
            $orderType = $this->convertObjectToArray($listCar);

            $genderType = array(
                Business::GENDER_MALE => __('label.male'),
                Business::GENDER_FEMALE => __('label.female'),
            );

            $orderMethod = array(
                Business::PAYMENT_METHOD_CASH => __('label.method_cash'),
                Business::PAYMENT_METHOD_MONTH => __('label.method_month'),
                Business::PAYMENT_METHOD_OTHER => __('label.method_other'),
            );
            $orderMethodColor = array(
                Business::PAYMENT_METHOD_CASH => 'label-danger',
                Business::PAYMENT_METHOD_MONTH => 'label-info',
                Business::PAYMENT_METHOD_OTHER => 'label-warning',
            );

            $listPayer = [
                Business::PAYER_RECEIVE => __('label.payer_receive'),
                Business::PAYER_SENDER => __('label.payer_sender'),
            ];

            $orderPayment = array(
                Business::PAYMENT_DONE => __('label.payment_done'),
                Business::PAYMENT_DEPT => __('label.payment_dept'),
            );
            $orderPaymentColor = array(
                Business::PAYMENT_DONE => 'label-success',
                Business::PAYMENT_DEPT => 'label-danger',
            );

            $listType = [
                Business::PRICE_BY_TH1 => __('label.th1'),
                Business::PRICE_BY_TH2 => __('label.th2'),
                Business::PRICE_BY_TH3 => __('label.th3'),
            ];

            $listTypeColor = [
                Business::PRICE_BY_TH1 => 'label-primary',
                Business::PRICE_BY_TH2 => 'label-danger',
                Business::PRICE_BY_TH3 => 'label-success',
            ];

            $listWarehouse = Warehouse::all();
            $config = $this->setConfigMaps();
            $config['directionsStart'] = optional($item->detail)->sender_address;
            $config['directionsEnd'] = optional($item->detail)->receive_address;
            app('map')->initialize($config);

            $map = app('map')->create_map();

            $title = $item->name;
            $payment = Order::getOrderPaymentDetail($id);
            $history_change_payment = Order::getListHistoryChangePayment($id);
            $receiverDriver = Delivery::getByID($id);
            $checkReceiverDriver = Delivery::checkReceiverDriver($id);
            return view('admin.order.detail', compact('checkReceiverDriver', 'receiverDriver', 'payment', 'history_change_payment', 'map', 'orderMethod', 'orderMethodColor', 'item', 'title', 'orderStatusColor', 'orderStatus', 'orderType', 'genderType', 'orderPayment', 'orderPaymentColor', 'listType', 'listTypeColor', 'listWarehouse', 'listPayer', 'listSpeed'));
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * @param null $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id = null, Request $request)
    {
        if ($request->ajax()) {
            $order = $this->repository->find($id);
            if ($order) {
                $order->status = $request->status;
                if ($order->save()) {
                    return response()->json(['code' => 200], HttpCode::SUCCESS);
                }
            }
        }
        return response()->json(['code' => 401], HttpCode::SUCCESS);
    }

    /**
     * @param null $id
     * @param int $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus($id = null, $status = Business::ORDER_STATUS_IHT_CANCEL)
    {
        $order = $this->repository->find($id);
        if ($order && $order->status == Business::ORDER_STATUS_WAITING) {
            $order->status = $status;
            if ($order->save()) {
                return redirect()->back()->with($this->messageResponse());
            }
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ajaxPrice($id, Request $request)
    {
        if ($request->ajax()) {
            $order = $this->repository->find($id);
            $order->total_price = $request->price ? str_replace(',', '', $request->price) : '-1';
            if ($order->save()) {
                return redirect()->back()->with($this->messageResponse());
            }
            return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
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
        $config['directions'] = true;
        $config['directionsDivID'] = 'directionsDiv';
        return $config;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSelect2(Request $request)
    {
        return response()->json($this->repository->ajaxSelect2($request));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function warehouse(Request $request)
    {
        $order = OrderDetail::where(['order_id' => $request->order_id])->first();
        if ($order) {
            $order->warehouse_id = $request->id_warehouse;
            if ($order->save()) {
                return redirect()->back()->with($this->messageResponse());
            }
            return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = __('label.create');
        $item = false;
        $orderMethod = array(
            Business::PAYMENT_METHOD_CASH => __('label.method_cash'),
            Business::PAYMENT_METHOD_MONTH => __('label.method_month'),
        );
        $orderPayment = array(
            Business::ORDER_STATUS_PAYMENT => __('label.payment_yes'),
            Business::ORDER_STATUS_NO_PAYMENT => __('label.payment_no'),
            Business::ORDER_STATUS_PAYMENT_DEPT => __('label.payment_dept'),
        );

        $listType = [
            Business::PRICE_BY_TH1 => 'Hàng hóa',
            Business::PRICE_BY_TH2 => 'Chứng từ',
            Business::PRICE_BY_TH4 => 'Làm hàng siêu thị',

        ];
        $listPayer = [
            Business::PAYER_RECEIVE => __('label.payer_receive'),
            Business::PAYER_SENDER => __('label.payer_sender'),
        ];
        return view('admin.order.form', compact(
            'title',
            'item',
            'orderMethod',
            'orderPayment',
            'listType',
            'listPayer'
        ));
    }

    /**
     * @param OrderRequest $request
     * @param OrderDetailRepositoryContract $detailRepositoryContract
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request, OrderDetailRepositoryContract $detailRepositoryContract)
    {
        $dataOrder = $request->only(
            'name',
            'payment_type',
            'car_type',
            'car_option',
            'user_id',
            'coupon_code',
            'payer',
            'is_speed'
        );
        $dataOrder['total_price'] = str_replace(',', '', $request->total_price);
        $dataOrder['is_admin'] = 1;
        $dataOrder['car_type'] = 0;
        $dataOrder['is_speed'] = 0;
        $orderId = $this->repository->store($dataOrder);
        if ($orderId) {
            $dataOrderDetail = $request->only(
                'sender_name',
                'sender_phone',
                'sender_address',
                'receive_name',
                'receive_phone',
                'receive_address',
                'weight',
                'note',
                'take_money'
            );
            if ($request->take_money) {
                $dataOrderDetail['take_money'] = str_replace(',', '', $request->take_money);
            }
            $dataOrderDetail['order_id'] = $orderId;
            if ($detailRepositoryContract->store($dataOrderDetail)) {
                return redirect(route('order.list'))->with($this->messageResponse());
            } else {
                $this->repository->delete($orderId);
            }
        }
        return redirect(route('order.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $provinceID
     * @param District $district
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function district($provinceID, District $district)
    {
        $listDistrict = $district->select('id', 'name as text')->where(['province_id' => $provinceID])->get();
        return response(['district' => $listDistrict]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment($id, Request $request)
    {
        $order = $this->repository->find($id);
        if ($order) {
            $order->is_payment = $request->is_payment;
            if ($order->save()) {
                return redirect()->back()->with($this->messageResponse());
            }
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function couponCode($id, Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|unique:orders,coupon_code',
        ]);

        $order = $this->repository->find($id);
        if ($order) {
            $order->coupon_code = $request->coupon_code;
            if ($order->save()) {
                return redirect()->back()->with($this->messageResponse());
            }
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adminNote($id, Request $request)
    {
        $request->validate([
            'admin_note' => 'required|max:255',
        ]);

        $order = OrderDetail::where(['order_id' => $id])->first();
        if ($order) {
            $order->admin_note = $request->admin_note;
            if ($order->save()) {
                return redirect()->back()->with($this->messageResponse());
            }
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }
    //raymond
    public function calculatePayment(Request $request)
    {
        try {
            $res = Order::calculatePayment($request);
            return back();
        } catch (\Exception $ex) {
            return $ex;
        }
    }
    public function changePayment(Request $request)
    {
        try {
            $res = Order::changePayment($request);
            return back();
        } catch (\Exception $ex) {
            return $ex;
        }
    }
    public function deleteOrder($id)
    {
        try {
            $order = Order::deleteOrder($id);
            if ($order = 200) {
                return back();
            }
        } catch (\Exception $ex) {
            return $ex;
        }
    }
    public function cancel(Request $request)
    {
        try {
            $res = Order::cancel($request);
            return back();
        } catch (\Exception $ex) {
            return $ex;
        }
    }
    public function print($id)
    {
        try {
            $order = Order::print($id);
            return view('admin.order.print', compact('order'));
        } catch (\Exception $ex) {
            return $ex;
        }
    }
}
