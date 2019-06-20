<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 11/12/18
 * Time: 10:50
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Repositories\Company\CompanyRepositoryContract;
use App\Repositories\Dept\DeptRepositoryContract;
use App\Services\ExcelService;
use Carbon\Carbon;
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

    /**
     * @param Request $request
     * @param ExcelService $excelService
     * @param CompanyRepositoryContract $repositoryContract
     */
    public function export(Request $request, ExcelService $excelService, CompanyRepositoryContract $repositoryContract)
    {
        $start = ($request->start_date) ? Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d') : Carbon::now()->subMonth()->startOfMonth();
        $end = ($request->end_date) ? Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d') : Carbon::now()->subMonth()->endOfMonth()->addDay();

        $data = [
            'from' => $start,
            'to' => $end
        ];
        $listCompany = $repositoryContract->findByCondition(['publish' => Business::PUBLISH], false, ['id']);
        foreach ($listCompany as $company){
            $insertData = array_merge($data, ['company_id' => $company->id]);
            $this->repository->store($insertData);
        }
        $listExport = $this->repository->findDataExport($start, $end);
        $excelService->exportCompany($listExport, $start, $end);
    }
}