<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 28/6/2018
 * Time: 11:27 AM
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Repositories\Driver\DriverRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Warehouse\WarehouseRepositoryContract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * @var DriverRepositoryContract
     */
    public $repository;

    /**
     * DriverController constructor.
     * @param DriverRepositoryContract $repositoryContract
     */
    public function __construct(DriverRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $title = __('label.driver');
        $listResult = $this->repository->getAll();
        return view('admin.driver.list', compact('listResult', 'title'));
    }

    /**
     * @param UserRepositoryContract $repositoryContract
     * @param WarehouseRepositoryContract $warehouseRepositoryContract
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(UserRepositoryContract $repositoryContract, WarehouseRepositoryContract $warehouseRepositoryContract)
    {
        $title = __('label.driver_create');
        $listUser = $repositoryContract->findByCondition(['level' => Business::USER_LEVEL_EMPLOYEE, 'baned' => Business::USER_UN_BANED], false);
        $listWarehouse = $warehouseRepositoryContract->getAll();
        $item = false;
        return view('admin.driver.form', compact('item', 'title', 'listUser', 'listWarehouse'));
    }

    /**
     * @param DriverRequest $request
     * @param UserRepositoryContract $userRepositoryContract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DriverRequest $request, UserRepositoryContract $userRepositoryContract)
    {
        $dataStore = $request->only('experience', 'identification', 'warehouse_id');
        $dataStore['date'] = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $userID = $userRepositoryContract->storeUser($request);
        if ($userID){
            $dataStore['user_id'] = $userID;
            if ($this->repository->store($dataStore)) {
                return redirect(route('driver.list'))->with($this->messageResponse());
            }
        }
        return redirect(route('driver.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param UserRepositoryContract $repositoryContract
     * @param WarehouseRepositoryContract $warehouseRepositoryContract
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, UserRepositoryContract $repositoryContract, WarehouseRepositoryContract $warehouseRepositoryContract)
    {
        $item = $this->repository->find($id);
        if ($item) {
            $title = __('label.driver_edit');
            $listUser = $repositoryContract->findByCondition(['level' => Business::USER_LEVEL_EMPLOYEE], false);
            $listWarehouse = $warehouseRepositoryContract->getAll();
            return view('admin.driver.form', compact('title', 'item', 'listUser', 'listWarehouse'));
        }
        return redirect(route('driver.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param DriverRequest $request
     * @param UserRepositoryContract $userRepositoryContract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, DriverRequest $request, UserRepositoryContract $userRepositoryContract)
    {
        $dataUpdate = $request->only('experience', 'identification', 'warehouse_id');
        $dataUpdate['date'] = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        if ($this->repository->update($id, $dataUpdate)) {
            $item = $this->repository->find($id);
            $request->id = $item->user_id;
            if ($userRepositoryContract->updateUser($request)){
                return redirect(route('driver.list'))->with($this->messageResponse());
            }
        }
        return redirect(route('driver.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        if ($this->repository->delete($id)) {
            return redirect(route('driver.list'))->with($this->messageResponse());
        }
        return redirect(route('driver.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSelect2(Request $request)
    {
        return response()->json($this->repository->ajaxGetDriver($request));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function detail($id, Request $request)
    {
        $item = $this->repository->find($id);
        if ($item){
            //dd(int($item->rateDriver($item->id)));
            $title = __('label.driver_detail');
            $listHistory = $this->repository->getHistoryDelivery($request, $id);
            $userStatus = array(
                Business::USER_ACTIVE => __('label.active'),
                Business::USER_UN_ACTIVE => __('label.un_active'),
            );
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
            $genderType = array(
                Business::GENDER_MALE => __('label.male'),
                Business::GENDER_FEMALE => __('label.female'),
            );
            $orderType = array(
                Business::SERVICE_TYPE_INTERNAL => __('label.service_internal'),
                Business::SERVICE_TYPE_PUBLIC => __('label.service_public')
            );
            $orderTypeColor = array(
                Business::SERVICE_TYPE_INTERNAL => 'label-primary',
                Business::SERVICE_TYPE_PUBLIC => 'label-success'
            );

            $userBaned = array(
                Business::USER_BANED => __('label.baned'),
                Business::USER_UN_BANED => __('label.un_baned'),
            );

            $config = $this->setConfigMaps();
            $config['center'] = "$item->lat, $item->lng";
            app('map')->initialize($config);

            $marker = array();
            $marker['position'] = "$item->lat, $item->lng";
            $marker['infowindow_content'] = $item->current_address;
            $marker['title'] = $item->user->name . ' (' . $item->phone . ')';
            app('map')->add_marker($marker);

            $map = app('map')->create_map();

            return view('admin.driver.detail', compact('userBaned', 'item', 'map', 'title', 'genderType', 'listHistory', 'userStatus', 'orderStatusColor', 'orderStatus', 'orderType', 'orderTypeColor'));
        }
        return abort(404);
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
        return $config;
    }
}