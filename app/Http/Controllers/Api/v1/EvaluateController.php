<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 1:09 PM
 */

namespace App\Http\Controllers\Api\v1;


use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use App\Http\Controllers\Api\ApiController;
use App\Repositories\Evaluate\EvaluateRepositoryContract;
use Illuminate\Http\Request;

class EvaluateController extends ApiController
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

    public function store(Request $request)
    {
        $data = $this->validateData($request, $this->setRule());
        if (!is_array($data)) {
            return $data;
        }
        $data['content'] = explode(',', $request->content);
        if ($this->repository->store($data)){
            return response()->json(MessageApi::success('success'), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::error([__('label.store_evaluate_error')], HttpCode::CREATE_ITEM_ERROR));
    }

    private function setRule()
    {
        return [
            'from_id' => 'required|exists:users,id',
            'to_id' => 'sometimes|nullable|exists:users,id',
            'type' => 'required|in:1,2,3',
            'rate' => 'sometimes|nullable|numeric|min:0|max:5'
        ];
    }
}