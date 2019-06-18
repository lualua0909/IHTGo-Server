<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 7/17/18
 * Time: 10:15
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinanceRequest;
use App\Repositories\Finance\FinanceRepositoryContract;
use App\Repositories\Order\OrderRepositoryContract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public $repository;

    public function __construct(FinanceRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    public function index(Request $request)
    {
        $listResult = $this->repository->getAll();
        $title = __('label.finance');
        $financeType = array(
            Business::FINANCE_TYPE_IN => __('label.finance_in'),
            Business::FINANCE_TYPE_OUT => __('label.finance_out')
        );
        $financeTypeColor = array(
            Business::FINANCE_TYPE_IN => 'label-primary',
            Business::FINANCE_TYPE_OUT => 'label-success'
        );
        return view('admin.finance.list', compact('listResult', 'title', 'financeType', 'financeTypeColor'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getList(Request $request)
    {
        $result = $this->repository->getListDataTable($request);
        return $result;
    }

    /**
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($type)
    {
        $title = __('label.finance_create');
        $item = false;
        return view('admin.finance.form', compact('type', 'title', 'item'));
    }

    public function store($type, FinanceRequest $request, OrderRepositoryContract $orderRepositoryContract)
    {
        $data = $request->only('name','note', 'order_id');
        $data['type'] = $type;
        $data['total'] = ($request->total) ? str_replace(',', '', $request->total) : null;
        $data['payment'] = ($request->payment) ? str_replace(',', '', $request->payment) : null;
        $data['own'] = ($request->own) ? str_replace(',', '', $request->own) : null;
        $data['date'] = ($request->date) ? Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d') : date('Y-m-d');
        $data['user_id'] = $request->user()->id;
        if ($this->repository->store($data)){
            if ($request->order_id){
                $orderRepositoryContract->update($request->order_id, ['is_payment' => Business::ORDER_STATUS_PAYMENT]);
            }
            return redirect(route('finance.list'))->with($this->messageResponse());
        }
        return redirect(route('finance.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    public function edit($type, $id)
    {
        $title = __('label.finance_edit');
        $item = $this->repository->find($id);
        return view('admin.finance.form', compact('type', 'title', 'item'));
    }

    public function update($type, $id, FinanceRequest $request, OrderRepositoryContract $orderRepositoryContract)
    {
        $data = $request->only('name','note', 'order_id');
        $data['type'] = $type;
        $data['total'] = ($request->total) ? str_replace(',', '', $request->total) : null;
        $data['payment'] = ($request->payment) ? str_replace(',', '', $request->payment) : null;
        $data['own'] = ($request->own) ? str_replace(',', '', $request->own) : null;
        $data['date'] = ($request->date) ? Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d') : date('Y-m-d');
        $data['user_id'] = $request->user()->id;
        if ($this->repository->update($id, $data)){
            if ($request->order_id){
                $orderRepositoryContract->update($request->order_id, ['is_payment' => Business::ORDER_STATUS_PAYMENT]);
            }
            return redirect(route('finance.list'))->with($this->messageResponse());
        }
        return redirect(route('finance.list'))->with($this->messageResponse('danger', __('label.failed')));
    }
}