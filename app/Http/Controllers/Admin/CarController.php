<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 2:26 PM
 */

namespace App\Http\Controllers\Admin;

use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Data\Other;
use App\Repositories\Car\CarRepositoryContract;
use App\Repositories\Driver\DriverRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * @var CarRepositoryContract
     */
    public $repository;

    /**
     * CarController constructor.
     * @param CarRepositoryContract $repositoryContract
     */
    public function __construct(CarRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $title = __('label.car');
        $carTypeOther = Other::select('id', 'name')->where(['type' => Business::OTHER_TYPE_CAR])->get()->pluck('name', 'id')->toArray();
        $carType = array(
            Business::CAR_TYPE_USER => __('label.car_user'),
            Business::CAR_TYPE_COMPANY => __('label.car_company'),
        );
        $listResult = $this->repository->getAll();
        return view('admin.car.list', compact('listResult', 'title', 'carType', 'carTypeOther'));
    }


    /**
     * @param DriverRepositoryContract $driverRepositoryContract
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(DriverRepositoryContract $driverRepositoryContract)
    {
        $carTypeOther = Other::select('id', 'name')->where(['type' => Business::OTHER_TYPE_CAR])->get()->pluck('name', 'id')->toArray();
        $carType = array(
            Business::CAR_TYPE_USER => __('label.car_user'),
            Business::CAR_TYPE_COMPANY => __('label.car_company'),
        );
        $listDriver = $driverRepositoryContract->findByCondition([], false, ['*']);
        $title = __('label.car_create');
        $item = false;
        return view('admin.car.form', compact('item', 'title', 'carType', 'listDriver', 'carTypeOther'));
    }

    /**
     * @param CarRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CarRequest $request)
    {
        $dataStore = $request->only( 'name', 'manufacturer', 'brand', 'weight', 'license_plate', 'owner_id', 'name', 'number', 'type', 'type_car');
        $dataStore['user_id'] = $request->user()->id;
        if ($this->repository->store($dataStore)) {
            return redirect(route('car.list'))->with($this->messageResponse());
        }
        return redirect(route('car.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param DriverRepositoryContract $driverRepositoryContract
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, DriverRepositoryContract $driverRepositoryContract)
    {
        $item = $this->repository->find($id);
        if ($item) {
            $carTypeOther = Other::select('id', 'name')->where(['type' => Business::OTHER_TYPE_CAR])->get()->pluck('name', 'id')->toArray();
            $carType = array(
                Business::CAR_TYPE_USER => __('label.car_user'),
                Business::CAR_TYPE_COMPANY => __('label.car_company'),
            );
            $title = __('label.car_edit');
            $listDriver = $driverRepositoryContract->findByCondition([], false, ['*']);
            return view('admin.car.form', compact('title', 'item', 'carType', 'listDriver', 'carTypeOther'));
        }
        return redirect(route('car.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param CarRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CarRequest $request)
    {
        $dataUpdate = $request->only( 'name', 'manufacturer', 'brand', 'weight', 'license_plate', 'owner_id', 'type', 'type_car');
        $dataUpdate['user_id'] = $request->user()->id;
        if ($this->repository->update($id, $dataUpdate)) {
            return redirect(route('car.list'))->with($this->messageResponse());
        }
        return redirect(route('car.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        if ($this->repository->delete($id)) {
            return redirect(route('car.list'))->with($this->messageResponse());
        }
        return redirect(route('car.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax(Request $request)
    {
        return response()->json($this->repository->ajaxGetCar($request), 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $item = $this->repository->find($id);
        if ($item){
            $title = __('label.car_detail');
            $listHistory = $this->repository->getHistoryDelivery($item->id);
            $orderStatus = array(
                Business::ORDER_STATUS_WAITING => __('label.waiting'),
                Business::ORDER_STATUS_NO_DELIVERY => __('label.no_delivery'),
                Business::ORDER_STATUS_BEING_DELIVERY => __('label.being_delivery'),
                Business::ORDER_STATUS_DONE_DELIVERY => __('label.done_delivery'),
                Business::ORDER_STATUS_CUSTOMER_CANCEL => __('label.customer_cancel'),
                Business::ORDER_STATUS_IHT_CANCEL => __('label.iht_cancel'),
            );
            $orderStatusColor = array(
                Business::ORDER_STATUS_WAITING => 'label-warning',
                Business::ORDER_STATUS_NO_DELIVERY => 'label-primary',
                Business::ORDER_STATUS_BEING_DELIVERY => 'label-info',
                Business::ORDER_STATUS_DONE_DELIVERY => 'label-success',
                Business::ORDER_STATUS_CUSTOMER_CANCEL => 'label-danger',
                Business::ORDER_STATUS_IHT_CANCEL => 'label-danger',
            );
            $carTypeOther = Other::select('id', 'name')->where(['type' => Business::OTHER_TYPE_CAR])->get()->pluck('name', 'id')->toArray();
            return view('admin.car.detail', compact('item', 'title', 'listHistory', 'orderStatusColor', 'orderStatus', 'carTypeOther'));
        }
        return abort(404);
    }
}