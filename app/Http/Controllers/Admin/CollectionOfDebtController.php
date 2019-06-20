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
use App\Http\Requests\CollectionOfDebtRequest;
use App\Repositories\CollectionOfDebt\CollectionOfDebtRepositoryContract;
use App\Repositories\Driver\DriverRepositoryContract;
use App\Repositories\User\UserRepositoryContract;
use Illuminate\Http\Request;

class CollectionOfDebtController  extends Controller
{

    private $repository;

    public function __construct(CollectionOfDebtRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function getList()
    {
        $title = __('label.collection_of_debt');
        $deptStatus = array(
            Business::COLLECTION_DEPT_WAITING => __('label.waiting'),
            Business::COLLECTION_DEPT_DONE => __('label.done'),
            Business::COLLECTION_DEPT_FAILED => __('label.failed')
        );
        $deptStatusColor = array(
            Business::COLLECTION_DEPT_WAITING => 'label-warning',
            Business::COLLECTION_DEPT_DONE => 'label-success',
            Business::COLLECTION_DEPT_FAILED => 'label-danger',
        );
        return view('admin.collection_of_debt.list', compact('title', 'deptStatus', 'deptStatusColor'));
    }

    public function postList(Request $request)
    {
        return $this->repository->getDataTable($request);
    }

    public function create()
    {
        $title = __('label.add_new');
        $item = false;
        return view('admin.collection_of_debt.form', compact('title', 'item'));
    }

    public function store(CollectionOfDebtRequest $request)
    {
        if ($this->repository->store($request->only('name', 'money'))) {
            return redirect(route('collection.list'))->with($this->messageResponse());
        }
        return redirect(route('collection.list'))->with($this->messageResponse('danger', __('label.failed')));

    }

    public function edit($id, UserRepositoryContract $repositoryContract)
    {
        $title = __('label.add_new');
        $item = $this->repository->find($id);
        if ($item){
            $listDriver = $repositoryContract->findByCondition(['level' => Business::USER_LEVEL_DRIVER], false, ['id', 'name']);
            return view('admin.collection_of_debt.form', compact('title', 'item', 'listDriver'));
        }
        return redirect(route('collection.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    public function update($id, CollectionOfDebtRequest $request)
    {
        if ($this->repository->update($id, $request->only('name', 'money', 'employee_id'))) {
            return redirect(route('collection.list'))->with($this->messageResponse());
        }
        return redirect(route('collection.list'))->with($this->messageResponse('danger', __('label.failed')));

    }

    public function delete($id)
    {
        if ($this->repository->delete($id)) {
            return redirect(route('collection.list'))->with($this->messageResponse());
        }
        return redirect(route('collection.list'))->with($this->messageResponse('danger', __('label.failed')));
    }
}