<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 9:54 AM
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementPriceRequest;
use App\Repositories\Setting\SettingRepositoryContract;

class SettingController extends Controller
{
    /**
     * @var SettingRepositoryContract
     */
    public $repository;

    /**
     * SettingController constructor.
     * @param SettingRepositoryContract $repositoryContract
     */
    public function __construct(SettingRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * Get List Management Price
     *
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listManagerPrice($id=null)
    {
        $item = ($id) ? $this->repository->find($id) : null;
        $title = __('label.management_price');
        $typeMoney = [
            Business::SETTING_MONEY_BY_KM => __('label.km'),
            Business::SETTING_MONEY_BY_SIZE => __('label.size'),
            Business::SETTING_MONEY_BY_WEIGHT => __('label.weight')
        ];
        $listResult = $this->repository->findSettingByCondition(['key' => Business::SETTING_PRICE]);
        return view('admin.setting.price', compact('item', 'listResult', 'title', 'typeMoney'));
    }

    /**
     * Store Management Price
     *
     * @param null $id
     * @param ManagementPriceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function actionManagerPrice($id=null,ManagementPriceRequest $request)
    {
        $data =  $request->only('type', 'value', 'name');
        $data['key'] = Business::SETTING_PRICE;
        $data['user_id'] = $request->user()->id;
        if ($id){
            $this->repository->update($id, $data);
            return redirect(route('price.list'))->with($this->messageResponse());
        }elseif ($this->repository->store($data)){
            return redirect(route('setting.price_list'))->with($this->messageResponse());
        }
        return redirect(route('setting.price_list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id=null)
    {
        if ($this->repository->delete($id)){
            return redirect(route('price.list'))->with($this->messageResponse());
        }
        return redirect(route('price.list'))->with($this->messageResponse('danger', __('label.failed')));
    }
}