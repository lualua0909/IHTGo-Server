<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/9/18
 * Time: 21:59
 */

namespace App\Http\Controllers\Api\v1;


use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use App\Http\Controllers\Api\ApiController;
use App\Repositories\CollectionOfDebt\CollectionOfDebtRepositoryContract;
use Illuminate\Http\Request;

class CollectionOfDebtController extends ApiController
{
    private $repository;

    public function __construct(CollectionOfDebtRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function getList(Request $request)
    {
        $result = $this->repository->findByCondition(['employee_id' => $request->user()->id], false, ['id', 'name', 'status', 'money']);
        return response()->json(MessageApi::success($result), HttpCode::SUCCESS);
    }

    public function update($id = null, Request $request)
    {
        $data = $this->validateData($request, $this->setRule());
        if (!is_array($data)) {
            return $data;
        }
        if ($this->repository->update($id, $data)){
            return response()->json(MessageApi::success($this->repository->find($id)), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::error([__('label.failed')]), HttpCode::CODE_UPDATE_ERROR);
    }

    /**
     * @return array
     */
    private function setRule()
    {
        $rule = [
            'status' => 'required|in:2,3',
            'note' => 'sometimes|nullable|string|max:190',
        ];
        return $rule;
    }
}