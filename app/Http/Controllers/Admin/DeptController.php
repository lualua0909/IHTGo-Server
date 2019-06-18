<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 11/12/18
 * Time: 10:50
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\Dept\DeptRepositoryContract;
use Illuminate\Http\Request;

class DeptController extends Controller
{
    /**
     * @var DeptRepositoryContract
     */
    public $repository;

    /**
     * CustomerController constructor.
     * @param DeptRepositoryContract $repositoryContract
     */
    public function __construct(DeptRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $title = __('label.dept');
        return view('admin.dept.list', compact('customerType', 'title'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getListDept(Request $request)
    {
        $listCustomer = $this->repository->getDeptDataTable($request);
        return $listCustomer;
    }
}