<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 29/6/2018
 * Time: 1:50 PM
 */

namespace App\Http\Controllers\Api\v1;


use App\Helpers\Business;
use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\DriverResource;
use App\Repositories\Driver\DriverRepositoryContract;
use App\Repositories\Order\OrderRepositoryContract;
use Illuminate\Http\Request;

class DriverController extends ApiController
{
    /**
     * @var DriverRepositoryContract
     */
    public $repository;

    /**
     * DriverController constructor.
     * @param DriverRepositoryContract $repositoryContract
     */
    public function __construct(DriverRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function location(Request $request)
    {
        $data = $this->validateData($request, $this->ruleLocation());
        if (!is_array($data)) {
            return $data;
        }
        $driverId = optional(optional($request->user())->driver)->id;
        $dataLocation = $request->only('lat', 'lng', 'current_address');
        if ($this->repository->update($driverId, $dataLocation)){
            return response()->json(MessageApi::success('success'), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::error([__('label.failed')]), HttpCode::SUCCESS);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function orders(Request $request)
    {
        $result = $this->repository->getHistoryDelivery($request);
        return DriverResource::collection($result)->additional(['status' => HttpCode::SUCCESS, 'error_code' => HttpCode::CODE_SUCCESS]);
    }

    /**
     * @param $id
     * @param OrderRepositoryContract $repositoryContract
     * @return \Illuminate\Http\JsonResponse
     */
    public function statusOrder($id, OrderRepositoryContract $repositoryContract)
    {
        $order = $repositoryContract->find($id);
        if ($order && $order->status == Business::ORDER_STATUS_DONE_DELIVERY){
            $order->status = Business::ORDER_STATUS_PAYMENT;
            if ($order->save()){
                return response()->json(MessageApi::success('success'), HttpCode::SUCCESS);
            }
            return response()->json(MessageApi::error([__('label.failed')], HttpCode::CODE_STATUS_ORDER_ERROR), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::error([__('label.failed')], HttpCode::ITEM_NOT_EXISTS), HttpCode::SUCCESS);
    }

    /**
     * @return array
     */
    private function ruleLocation()
    {
        $rule = [
            'current_address' => 'required|string|max:199',
            'lat' => 'required',
            'lng' => 'required'
        ];
        return $rule;
    }

    public function getLocation($id, Request $request)
    {
        $driver = $this->repository->find($id);
        if ($driver){
            return response()->json(MessageApi::success(['lat' => $driver->lat, 'lng' => $driver->lng, 'current_address' => $driver->current_address]), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::error([__('label.failed')], HttpCode::ITEM_NOT_EXISTS), HttpCode::SUCCESS);
    }
}