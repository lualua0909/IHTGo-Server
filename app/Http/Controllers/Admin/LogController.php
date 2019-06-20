<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/4/18
 * Time: 22:49
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\Log\LogRepositoryContact;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * @var LogRepositoryContact
     */
    public $repository;

    /**
     * CustomerController constructor.
     * @param LogRepositoryContact $repositoryContract
     */
    public function __construct(LogRepositoryContact $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = __('label.log');
        return view('admin.log.list', compact('title'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getList(Request $request)
    {
        $result = $this->repository->getDataTable($request);
        return $result;
    }
}