<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 11:40 AM
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Repositories\Evaluate\EvaluateRepositoryContract;
use Illuminate\Http\Request;

class EvaluateController extends Controller
{
    /**
     * @var EvaluateRepositoryContract
     */
    public $repository;

    /**
     * EvaluateController constructor.
     * @param EvaluateRepositoryContract $repositoryContract
     */
    public function __construct(EvaluateRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList(Request $request)
    {
        $title = __('label.evaluate');
        $customerType = array(
            Business::EVALUATE_TYPE_SERVICE => __('label.service'),
            Business::EVALUATE_TYPE_DRIVE => __('label.drive'),
            Business::EVALUATE_TYPE_CUSTOMER => __('label.customer'),
        );
        $customerTypeColor = array(
            Business::EVALUATE_TYPE_SERVICE => 'label-success',
            Business::EVALUATE_TYPE_DRIVE => 'label-danger',
            Business::EVALUATE_TYPE_CUSTOMER => 'label-warning',
        );

        return view('admin.evaluate.list', compact('customerType', 'title', 'customerTypeColor'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getListEvaluate(Request $request)
    {
        $listCustomer = $this->repository->getCustomerDataTable($request);
        return $listCustomer;
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id)
    {
        $item = $this->repository->find($id);
        $title = __('label.evaluate_detail');
        $evaluateType = array(
            Business::EVALUATE_TYPE_SERVICE => __('label.service'),
            Business::EVALUATE_TYPE_DRIVE => __('label.drive'),
            Business::EVALUATE_TYPE_CUSTOMER => __('label.customer'),
        );
        $genderType = array(
            Business::GENDER_MALE => __('label.male'),
            Business::GENDER_FEMALE => __('label.female'),
        );
        return view('admin.evaluate.detail', compact('item', 'title', 'evaluateType', 'genderType'));
    }
}