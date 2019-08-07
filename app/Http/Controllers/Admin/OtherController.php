<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 8:07 AM
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\OtherRequest;
use App\Repositories\Other\OtherRepositoryContract;

class OtherController extends Controller
{
    /**
     * @var OtherRepositoryContract
     */
    public $repository;

    /**
     * OtherController constructor.
     * @param OtherRepositoryContract $repositoryContract
     */
    public function __construct(OtherRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList($id=null)
    {
        $item = ($id) ? $this->repository->find($id) : null;
        $title = __('label.other');
        $typeOther = [
            Business::OTHER_TYPE_DRIVE => __('label.drive'),
            Business::OTHER_TYPE_SERVICE => __('label.service'),
            Business::OTHER_TYPE_CUSTOMER => __('label.customer'),
            Business::OTHER_TYPE_CAR => __('label.type_car'),
        ];
        $typeOtherColor = [
            Business::OTHER_TYPE_DRIVE => 'success',
            Business::OTHER_TYPE_SERVICE => 'danger',
            Business::OTHER_TYPE_CUSTOMER => 'warning',
            Business::OTHER_TYPE_CAR => 'primary',
        ];
        $listResult = $this->repository->getAll();
        return view('admin.data.other.list', compact('item', 'listResult', 'typeOther', 'title', 'typeOtherColor'));
    }

    /**
     * @param null $id
     * @param OtherRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function action($id=null,OtherRequest $request)
    {
        $data =  $request->only('type', 'name');
        $data['user_id'] = $request->user()->id;
        if ($id){
            $this->repository->update($id, $data);
            return redirect(route('other.list'))->with($this->messageResponse());
        }elseif ($this->repository->store($data)){
            return redirect(route('other.list'))->with($this->messageResponse());
        }
        return redirect(route('other.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id=null)
    {
        if ($this->repository->delete($id)){
            return redirect(route('other.list'))->with($this->messageResponse());
        }
        return redirect(route('other.list'))->with($this->messageResponse('danger', __('label.failed')));
    }
}