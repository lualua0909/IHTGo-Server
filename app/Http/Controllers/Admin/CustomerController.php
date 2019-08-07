<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 2:28 PM
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Repositories\Customer\CustomerRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use App\Services\ExcelService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @var CustomerRepositoryContract
     */
    public $repository;

    /**
     * CustomerController constructor.
     * @param CustomerRepositoryContract $repositoryContract
     */
    public function __construct(CustomerRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $title = __('label.customer');
        $customerType = array(
            Business::CUSTOMER_TYPE_USER => __('label.customer_user'),
            Business::CUSTOMER_TYPE_COMPANY => __('label.customer_company'),
        );
        $customerTypeColor = array(
            Business::CUSTOMER_TYPE_USER => 'label-success',
            Business::CUSTOMER_TYPE_COMPANY => 'label-danger'
        );

        $userStatus = array(
            Business::USER_ACTIVE => __('label.active'),
            Business::USER_UN_ACTIVE => __('label.un_active'),
        );
        $userStatusColor = array(
            Business::USER_ACTIVE => 'label-success',
            Business::USER_UN_ACTIVE => 'label-danger',
        );

        return view('admin.customer.list', compact('customerType', 'title', 'customerTypeColor', 'userStatus', 'userStatusColor'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getListCustomer(Request $request)
    {
        $listCustomer = $this->repository->getCustomerDataTable($request);
        return $listCustomer;
    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id=null)
    {
        $item = $this->repository->find($id);
        if ($item){
            $title = __('label.customer_detail');
            $orderStatus = array(
                Business::ORDER_STATUS_WAITING => __('label.waiting'),
                Business::ORDER_STATUS_NO_DELIVERY => __('label.no_delivery'),
                Business::ORDER_STATUS_BEING_DELIVERY => __('label.being_delivery'),
                Business::ORDER_STATUS_DONE_DELIVERY => __('label.done_delivery'),
                Business::ORDER_STATUS_CUSTOMER_CANCEL => __('label.customer_cancel'),
                Business::ORDER_STATUS_IHT_CANCEL => __('label.iht_cancel'),
                Business::ORDER_STATUS_FAIL => __('label.iht_failed'),
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

            $orderType = array(
                Business::SERVICE_TYPE_INTERNAL => __('label.service_internal'),
                Business::SERVICE_TYPE_PUBLIC => __('label.service_public')
            );
            $orderTypeColor = array(
                Business::SERVICE_TYPE_INTERNAL => 'label-primary',
                Business::SERVICE_TYPE_PUBLIC => 'label-success'
            );

            $genderType = array(
                Business::GENDER_MALE => __('label.male'),
                Business::GENDER_FEMALE => __('label.female'),
            );

            $orderMethod = array(
                Business::PAYMENT_METHOD_CASH => __('label.method_cash'),
                Business::PAYMENT_METHOD_MONTH =>__('label.method_month'),
                Business::PAYMENT_METHOD_OTHER => __('label.method_other')
            );
            $orderMethodColor = array(
                Business::PAYMENT_METHOD_CASH => 'label-danger',
                Business::PAYMENT_METHOD_MONTH => 'label-info',
                Business::PAYMENT_METHOD_OTHER => 'label-warning'
            );
            $customerType = array(
                Business::CUSTOMER_TYPE_USER => __('label.customer_user'),
                Business::CUSTOMER_TYPE_COMPANY => __('label.customer_company'),
            );
            $userStatus = array(
                Business::USER_ACTIVE => __('label.active'),
                Business::USER_UN_ACTIVE => __('label.un_active'),
            );
            $userBaned = array(
                Business::USER_BANED => __('label.baned'),
                Business::USER_UN_BANED => __('label.un_baned'),
            );
            return view('admin.customer.detail', compact('title', 'item', 'orderMethodColor', 'orderStatus', 'orderStatusColor','orderMethod', 'orderType', 'orderTypeColor', 'genderType', 'customerType', 'userStatus', 'userBaned'));
        }
        return abort(404);
    }

    /**
     * @param Request $request
     * @param ExcelService $excelService
     * @return mixed
     */
    public function exportDebt(Request $request, ExcelService $excelService)
    {
        $orderStatus = array(
            Business::ORDER_STATUS_WAITING => __('label.waiting'),
            Business::ORDER_STATUS_NO_DELIVERY => __('label.no_delivery'),
            Business::ORDER_STATUS_BEING_DELIVERY => __('label.being_delivery'),
            Business::ORDER_STATUS_DONE_DELIVERY => __('label.done_delivery'),
            Business::ORDER_STATUS_CUSTOMER_CANCEL => __('label.customer_cancel'),
            Business::ORDER_STATUS_IHT_CANCEL => __('label.iht_cancel'),
        );

        $start = ($request->start_date) ? Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d') : Carbon::now()->subMonth()->startOfMonth();
        $end = ($request->end_date) ? Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d') : Carbon::now()->subMonth()->endOfMonth()->addDay();

        $viewStart = ($request->start_date) ? ($request->start_date) : $start->format('d/m/Y');
        $viewEnd = ($request->end_date) ? ($request->end_date) : $end->format('d/m/Y');
        $result = $this->repository->getDebtCustomer($request->customer_id, $start, $end);
        $item = $this->repository->find($request->customer_id);
        return $excelService->exportDebt($item, $result, $viewStart, $viewEnd, $orderStatus);
    }

    /**
     * @param $id
     * @param UserRepositoryContract $userRepositoryContract
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activated($id, UserRepositoryContract $userRepositoryContract)
    {
        $item = $this->repository->find($id);
        if ($item){
            if ($userRepositoryContract->update($item->user_id, ['activated' => Business::USER_ACTIVE])){
                return redirect()->back()->with($this->messageResponse());
            }
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxSelect2(Request $request)
    {
        return response()->json($this->repository->ajaxSelect2($request));
    }
}