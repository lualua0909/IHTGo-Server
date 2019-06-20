<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/9/18
 * Time: 21:41
 */

namespace App\Http\Controllers\Api\v1;


use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use App\Http\Controllers\Api\ApiController;
use App\Repositories\Company\CompanyRepositoryContract;
use Illuminate\Http\Request;

class CompanyController extends ApiController
{
    private $repository;

    public function __construct(CompanyRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function getList(Request $request)
    {
        $result = $this->repository->getCompanyForApi($request);
        return response()->json(MessageApi::success($result), HttpCode::SUCCESS);
    }
}