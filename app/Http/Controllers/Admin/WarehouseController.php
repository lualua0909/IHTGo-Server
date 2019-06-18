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
use App\Http\Requests\WarehouseRequest;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Warehouse\WarehouseRepositoryContract;

class WarehouseController extends Controller
{
    /**
     * @var WarehouseRepositoryContract
     */
    public $repository;

    /**
     * WarehouseController constructor.
     * @param WarehouseRepositoryContract $repositoryContract
     */
    public function __construct(WarehouseRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $title = __('label.warehouse');
        $listResult = $this->repository->getAll();
        return view('admin.warehouse.list', compact('listResult', 'title'));
    }

    /**
     * @param UserRepositoryContract $repositoryContract
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(UserRepositoryContract $repositoryContract)
    {
        $title = __('label.warehouse_create');
        $item = false;
        $listUser = $repositoryContract->findByCondition(['level' => Business::USER_LEVEL_ADMIN], false, ['id', 'name']);
        return view('admin.warehouse.form', compact('item', 'title', 'listUser'));
    }

    /**
     * @param WarehouseRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WarehouseRequest $request)
    {
        $dataStore = $request->only( 'code','manager_id','distribution','acreage','address');
        $dataStore['user_id'] = $request->user()->id;
        if ($this->repository->store($dataStore)) {
            return redirect(route('warehouse.list'))->with($this->messageResponse());
        }
        return redirect(route('warehouse.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param UserRepositoryContract $repositoryContract
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id, UserRepositoryContract $repositoryContract)
    {
        $item = $this->repository->find($id);
        if ($item) {
            $title = __('label.warehouse_edit');
            $listUser = $repositoryContract->findByCondition(['level' => Business::USER_LEVEL_ADMIN], false, ['id', 'name']);
            return view('admin.warehouse.form', compact('title', 'item', 'listUser'));
        }
        return redirect(route('warehouse.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param WarehouseRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, WarehouseRequest $request)
    {
        $dataUpdate = $request->only( 'code','manager_id','distribution','acreage','address');
        $dataUpdate['user_id'] = $request->user()->id;
        if ($this->repository->update($id, $dataUpdate)) {
            return redirect(route('warehouse.list'))->with($this->messageResponse());
        }
        return redirect(route('warehouse.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        if ($this->repository->delete($id)) {
            return redirect(route('warehouse.list'))->with($this->messageResponse());
        }
        return redirect(route('warehouse.list'))->with($this->messageResponse('danger', __('label.failed')));
    }
}