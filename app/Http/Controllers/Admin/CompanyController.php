<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/9/18
 * Time: 16:29
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Data\District;
use App\Models\Data\Province;
use App\Repositories\Company\CompanyRepositoryContract;
use App\Services\ExcelService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @var CompanyRepositoryContract
     */
    private $repository;

    /**
     * CompanyController constructor.
     * @param CompanyRepositoryContract $repository
     */
    public function __construct(CompanyRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $title = __('label.company');
        return view('admin.company.list', compact('title'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postList(Request $request)
    {
        return $this->repository->getDataTable($request);
    }

    /**
     * @param Province $province
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Province $province)
    {
        $title = __('label.add_new');
        $item = false;
        $listProvince = $province->get(['province_id', 'name']);
        return view('admin.company.form', compact('title', 'item', 'listProvince'));
    }

    /**
     * @param CompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyRequest $request)
    {
        if ($this->repository->store($request->only('name', 'address', 'province_id', 'district_id', 'phone', 'tax'))) {
            return redirect(route('company.list'))->with($this->messageResponse());
        }
        return redirect(route('company.list'))->with($this->messageResponse('danger', __('label.failed')));

    }

    /**
     * @param $id
     * @param Province $province
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, Province $province)
    {
        $title = __('label.edit');
        $item = $this->repository->find($id);
        if ($item){
            $listProvince = $province->get(['province_id', 'name']);
            $listDistrict = District::where(['province_id' => $item->province_id])->get(['id', 'name']);
            return view('admin.company.form', compact('title', 'item', 'listProvince', 'listDistrict'));
        }
        return redirect(route('company.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param CompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CompanyRequest $request)
    {
        if ($this->repository->update($id, $request->only('name', 'address', 'province_id', 'district_id', 'phone', 'tax'))) {
            return redirect(route('company.list'))->with($this->messageResponse());
        }
        return redirect(route('company.list'))->with($this->messageResponse('danger', __('label.failed')));

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function detail($id)
    {
        $item = $this->repository->find($id);
        if ($item){
            $title = __('label.detail');
            return view('admin.company.detail', compact('title', 'item'));
        }
        return redirect(route('company.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        if ($this->repository->delete($id)) {
            return redirect(route('company.list'))->with($this->messageResponse());
        }
        return redirect(route('company.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param Request $request
     * @param ExcelService $excelService
     * @return mixed
     */
    public function export(Request $request, ExcelService $excelService)
    {
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

        $listPayer = [
            Business::PAYER_RECEIVE => __('label.payer_receive'),
            Business::PAYER_SENDER => __('label.payer_sender'),
        ];

        $orderPayment = array(
            Business::ORDER_STATUS_PAYMENT => __('label.payment_yes'),
            Business::ORDER_STATUS_NO_PAYMENT => __('label.payment_no'),
            Business::ORDER_STATUS_PAYMENT_DEPT => __('label.payment_dept')
        );

        //Carbon::now()->startOfDay()
        $start = ($request->start_date) ? Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d') : Carbon::now()->subMonth()->startOfMonth();

        $end = ($request->end_date) ? Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d') : Carbon::now()->subMonth()->endOfMonth()->addDay();

        $viewStart = ($request->start_date) ? ($request->start_date) : $start->format('d/m/Y');
        $viewEnd = ($request->end_date) ? ($request->end_date) : $end->format('d/m/Y');
        $result = $this->repository->getDebt($request->company_id, $start . ' 00:00:00', $end . ' 23:59:59');
        $item = $this->repository->find($request->company_id);
        return $excelService->exportDebt($item, $result, $viewStart, $viewEnd, $orderStatus, $listType, $listPayer, $orderPayment);
    }
}