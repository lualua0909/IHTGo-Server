<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 27/6/2018
 * Time: 11:04 AM
 */

namespace App\Http\Controllers\Api\v1;


use App\Helpers\Business;
use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\OrderResource;
use App\Models\Data\District;
use App\Models\ManagerPrice;
use App\Models\OrderDetail;
use App\Models\OrderReceive;
use App\Repositories\Order\OrderRepositoryContract;
use App\Repositories\OrderDetail\OrderDetailRepositoryContract;
use App\Services\SocketClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends ApiController
{
    /**
     * @var OrderRepositoryContract
     */
    public $repository;

    /**
     * OrderController constructor.
     * @param OrderRepositoryContract $repositoryContract
     */
    public function __construct(OrderRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @param $id
     * @return OrderResource
     */
    public function detail($id)
    {
        $item = $this->repository->find($id);
        if ($item){
            return new OrderResource($item);
        }
        return response()->json(MessageApi::error([MessageApi::ITEM_DOES_NOT_EXISTS]), HttpCode::SUCCESS);
    }

    /**
     * @param Request $request
     * @param OrderDetailRepositoryContract $detailRepositoryContract
     * @return OrderResource|array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request, OrderDetailRepositoryContract $detailRepositoryContract)
    {
        $data = $this->validateData($request, $this->setRule());
        if (!is_array($data)) {
            return $data;
        }
        $dataOrder = $request->only('name', 'type', 'total_price' , 'payment_type','car_type', 'car_option', 'payer', 'is_speed');
        $dataOrder['user_id'] = $request->user()->id;
        $orderId = $this->repository->store($dataOrder);
        if ($orderId){
            $dataOrderDetail =  $request->only('sender_name', 'sender_phone','sender_address', 'receive_name',
                'receive_phone', 'price_id', 'receive_address', 'km', 'weight', 'sender_province_id', 'sender_district_id',
                'receive_province_id', 'receive_district_id', 'note', 'take_money');
            $dataOrderDetail['order_id'] = $orderId;
            $dataOrderDetail['sender_date'] = ($request->sender_date) ? Carbon::createFromFormat('d/m/Y', $request->sender_date)
                ->format('Y-m-d') : date('Y-m-d');
            $dataOrderDetail['receive_date'] = ($request->receive_date) ? Carbon::createFromFormat('d/m/Y', $request->receive_date)
                ->format('Y-m-d') : null;

            if ($request->receive){
                $receiveOrder = $this->addOrderIdToReceive($request->receive, $orderId, $dataOrder['user_id']);
                OrderReceive::insert($receiveOrder);
            }
            if ($detailRepositoryContract->store($dataOrderDetail)){
                return new OrderResource($this->repository->find($orderId));
            }else{
                $this->repository->delete($orderId);
            }
        }
        return response()->json(MessageApi::error([__('label.failed')]), HttpCode::CREATE_ITEM_ERROR);
    }

    private function addOrderIdToReceive($receiveOld, $orderID, $userID)
    {
        //$newReceive = str_replace("'", '\"', $receiveOld);
        //$receive = json_decode($receiveOld, true);
        $arr = ['order_id' => $orderID, 'user_id' => $userID];
        $arrResponse= [];
        if (is_array($receiveOld)){
            foreach ($receiveOld as $item){
                $newItem = array_merge($item, $arr);
                array_push($arrResponse, $newItem);
            }
        }
        return $arrResponse;
    }

    /**
     * @return array
     */
    private function setRule()
    {
        $rule = [
            'name' => 'required',
            'car_type' => 'required|exists:others,id',
            'total_price' => 'required',
            'payment_type' => 'sometimes|nullable|in:1,2,3',
            'car_option' => 'sometimes|nullable|in:1,2,3',
            'sender_name' => 'required',
            'sender_phone' => 'required',
            'sender_address' => 'required',
            'sender_date' => 'sometimes|nullable|date_format:d/m/Y' ,
            'receive_name' => 'required',
            'receive_phone' => 'required',
            'receive_address' => 'required',
            'receive_date' => 'sometimes|nullable|date_format:d/m/Y',
            'sender_province_id' => 'required',
            'sender_district_id' => 'required',
            'receive_province_id' => 'required',
            'receive_district_id' => 'required',
            'price_id' => 'required',
            'payer' => 'required|in:1,2'
        ];
        return $rule;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listOrder(Request $request)
    {
        $data = $this->validateData($request, $this->setRuleGetList());
        if (!is_array($data)) {
            return $data;
        }
        $result = $this->repository->getList($request);
        return OrderResource::collection($result)->additional(['status' => HttpCode::SUCCESS,
            'error_code' => HttpCode::CODE_SUCCESS]);
        //return response()->json($result, HttpCode::SUCCESS);
    }

    /**
     * @return array
     */
    private function setRuleGetList()
    {
        $rule = [
            'type' => 'sometimes|nullable|in:1,2',
            'status' => 'sometimes|nullable|in:1,2,3,4,5,6',
            'date' => 'sometimes|nullable|date_format:d/m/Y'
        ];
        return $rule;
    }

    /**
     * @param $id
     * @param Request $request
     * @param OrderDetailRepositoryContract $detailRepositoryContract
     * @return OrderResource|\Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request, OrderDetailRepositoryContract $detailRepositoryContract)
    {
        $order = $this->repository->find($id);
        if ($order){
            if ($order->status == Business::ORDER_STATUS_WAITING){
                $dataOrder = $request->only('name', 'car_type', 'car_option', 'temporary_price', 'status' ,
                    'total_price' , 'payment_type', 'type', 'payer');
                $this->repository->update($id, $dataOrder);
                $dataOrderDetail =  $request->only('sender_name', 'sender_phone','sender_address', 'receive_name',
                    'receive_phone', 'note', 'receive_address', 'km', 'size', 'weight', 'sender_province_id',
                    'sender_district_id', 'receive_province_id', 'receive_district_id', 'take_money');
                if ($request->sender_date){
                    $dataOrderDetail['sender_date'] = Carbon::createFromFormat('d/m/Y', $request->sender_date)
                        ->format('Y-m-d');
                }
                if ($request->receive_date){
                    $dataOrderDetail['receive_date'] = Carbon::createFromFormat('d/m/Y', $request->receive_date)
                        ->format('Y-m-d');
                }
                if ($dataOrderDetail){
                    $detailRepositoryContract->updateOderDetailByCondition(['order_id' => $id], $dataOrderDetail);
                }

                if ($request->receive){
                    OrderReceive::where(['order_id' => $id])->delete();
                    $receiveOrder = $this->addOrderIdToReceive($request->receive, $id, $order->user_id);
                    OrderReceive::insert($receiveOrder);
                }

                return new OrderResource(optional($this->repository->find($id)));
            }
            return response()->json(MessageApi::error([__('label.can_not_update_item')]), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::error([MessageApi::ITEM_DOES_NOT_EXISTS]), HttpCode::SUCCESS);
    }

    public function updateByDriver($id, Request $request)
    {
        $order = $this->repository->find($id);
        if ($order){
            //if ($order->status == Business::ORDER_STATUS_BEING_DELIVERY || $order->status == Business::ORDER_STATUS_NO_DELIVERY
            //  || $order->status == Business::ORDER_STATUS_WAITING){
                $dataOrder = $request->only( 'status');
                if ($request->driver_note){
                    OrderDetail::where(['order_id' => $id])->update(['driver_note' => $request->driver_note]);
                }
                $this->repository->update($id, $dataOrder);
                return new OrderResource(optional($this->repository->find($id)));
            //}
            //return response()->json(MessageApi::error([__('label.can_not_update_item')]), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::error([MessageApi::ITEM_DOES_NOT_EXISTS]), HttpCode::SUCCESS);
    }

    /**
     * @param $id
     * @param OrderDetailRepositoryContract $detailRepositoryContract
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id, OrderDetailRepositoryContract $detailRepositoryContract)
    {
        $order = $this->repository->find($id);
        if ($order){
            if ($order->status == Business::ORDER_STATUS_WAITING){
                $detailId = $order->detail->id;
                if ($order->delete()){
                    $detailRepositoryContract->delete($detailId);
                    OrderReceive::where(['order_id' => $id])->delete();
                    return response()->json(MessageApi::success('success'), HttpCode::SUCCESS);
                }
            }
            return response()->json(MessageApi::error([__('label.can_not_delete_item')]), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::error([MessageApi::ITEM_DOES_NOT_EXISTS]), HttpCode::SUCCESS);
    }

    /**
     * @param Request $request
     * @param District $district
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getPayment(Request $request, District $district)
    {
        $data = $this->validateData($request, $this->ruleGetMoney());
        if (!is_array($data)) {
            return $data;
        }

        $conditionModel = [
            'type_car' => $request->type_car,
            'type' => $request->type,
            'publish' => Business::PUBLISH,
            'to' => $request->receive_province_id,
            'from' => $request->sender_province_id
        ];
        if ($request->type == Business::PRICE_BY_TH1){
            unset($conditionModel['to']);
        }

        $payment = $this->calculateMoneyV3($conditionModel, $request);

        if ($payment){
            if ($payment['payment']){
                if ($request->is_speed){
                    $payment['payment'] = $payment['payment'] * Business::ORDER_SPEED_PAYMENT;
                }
                return response()->json(['data' => $payment, 'status' => HttpCode::SUCCESS, 'error_code' => HttpCode::CODE_SUCCESS]);
            }else{
                return response()->json(MessageApi::error([], HttpCode::CODE_STATUS_ORDER_ERROR_PAYMENT));
            }
        }
        return response()->json(MessageApi::error([], HttpCode::CODE_VALIDATE_IN_VALID));
    }

    /**
     * @return array
     */
    private function ruleGetMoney()
    {
        return [
            'type_car' => 'required|exists:others,id',
            'type' => 'required|in:1,2,3',
            'sender_province_id' => 'required_if:type,2,3',
            'receive_province_id' => 'required_if:type,2,3',
            'kg' => 'required_if:type,3,2',
            'is_seed' => 'sometimes|nullable|in:0,1'
        ];
    }

    /**
     * Tinh tien
     *
     * @param $conditionModel
     * @param Request $request
     * @return array|bool
     */
    private function calculateMoney($conditionModel, Request $request)
    {
        try{
            $config = ManagerPrice::where($conditionModel)->first();
            $check = ($config->option == Business::SETTING_MONEY_BY_KM) ? true : false;

            // neu check la dung thi lay km, sai thi lay kg
            $type = $check ? $this->getKilometerByMaps($request->start, $request->end) : $request->kg;
            if ($type){
                $max = false;
                $payment = $config->min_value;
                if ($config->advance && $type > $config->min){
                    foreach ($config->advance as $k => $advance){
                        if ($type <= $advance['to']){ // neu gia tri type nho hon gia tri nang cao
                            $payment += ($type - $advance['from']) * $advance['value'];
                        }else{
                            $payment += ($advance['to'] - $advance['from']) * $advance['value'];
                        }
                        $max = ($type > $advance['to']) ? $advance['to'] : false;
                    }
                }
                if($max){
                    $difference = $type - $max;
                    $quotient = $this->getQuotient($difference, $config->increase);
                    $payment += $quotient*$config->increase_value;
                }
                $result = ($check) ? ['km' => $type, 'payment' => $payment] : ['payment' => $payment];
                return $result;
            }
            return false;

        }catch (\Exception $exception){
            logger(['service' => 'Get Payment Api', 'content' => $exception->getMessage()]);
            return false;
        }
    }

    /**
     * Tinh tien
     *
     * @param $conditionModel
     * @param Request $request
     * @return array|bool
     */
    private function calculateMoneyV2($conditionModel, Request $request)
    {
        try{
            $config = ManagerPrice::where($conditionModel)->first();
            $check = ($config->option == Business::SETTING_MONEY_BY_KM) ? true : false;

            // neu check la dung thi lay km, sai thi lay kg
            $type = $check ? $this->getKilometerByMaps($request->start, $request->end) : $request->kg;
            if ($type){

                if ($request->type == Business::PRICE_BY_TH1 && $request->type_car == Business::CAR_TYPE_MOTORBIKE && $type > $config->min){
                    return ['payment' => false, 'price_id' => $config->id];
                }

                $payment = $config->min_value;
                if ($type && $type > $config->min && $config->increase){
                    $difference = $type - $config->min;
                    $quotient = $this->getQuotient($difference, $config->increase);
                    $payment += $quotient*$config->increase_value;
                }

                if ($request->receive && $config->address_payment && $config->address_receive){
                    $quotientAddress = $this->getQuotient($request->receive, $config->address_receive);
                    $payment += $quotientAddress*$config->address_payment;
                }
                $result = ($check) ? ['km' => $type, 'payment' => $payment, 'price_id' => $config->id]
                    : ['payment' => $payment, 'price_id' => $config->id];
                return $result;
            }
            return false;

        }catch (\Exception $exception){
            logger(['service' => 'Get Payment Api', 'content' => $exception->getMessage()]);
            return false;
        }
    }

    /**
     * tinh thuong cua 2 so
     *
     * @param $dividend
     * @param $divisor
     * @return float|int
     */
    private function getQuotient($dividend, $divisor)
    {
        $quotient = ($dividend % $divisor == 0) ? $dividend/$divisor : intdiv($dividend, $divisor) + 1;
        return $quotient;
    }

    /**
     * Tinh so km giao hang
     *
     * @param $start
     * @param $end
     * @return bool|mixed
     */
    private function getKilometerByMaps($start, $end)
    {
        $urlBasic = sprintf(Business::GOOGLE_URL_GET_INFO, $start, $end);
        $url = str_replace(' ', '+', $urlBasic);
        try{
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                ],
            ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                logger(['service' => 'Get Km by google maps', 'content' => "cURL Error #:" . $err]);
                return false;
            } else{
                $km = str_replace(' km', '', json_decode($response, true)['rows'][0]['elements'][0]['distance']['text']);
                return $km;
            }
        }catch (\Exception $exception){
            logger(['service' => 'Get Km by google maps', 'content' => $exception->getMessage()]);
            return false;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function suggest(Request $request)
    {
        $results = DB::table('order_receives')
            ->where(['user_id' => $request->user()->id])
            ->select(['district_id', 'province_id', 'phone', 'address', 'name'])
            ->distinct('district_id')
            ->get();
        return response()->json(MessageApi::success($results), HttpCode::SUCCESS);
    }

    /**
     * Tinh tien
     *
     * @param $conditionModel
     * @param Request $request
     * @return array|bool
     */
    private function calculateMoneyV3($conditionModel, Request $request)
    {
        try{
            $config = ManagerPrice::where($conditionModel)->first();
            if ($config) {
                $check = ($config->option == Business::SETTING_MONEY_BY_KM) ? true : false;

                // neu check la dung thi lay km, sai thi lay kg
                $type = $check ? $this->getKilometerByMaps($request->start, $request->end) : $request->kg;
                if ($type){

                    if ($request->type == Business::PRICE_BY_TH1 && $request->type_car == Business::CAR_TYPE_MOTORBIKE && $type > $config->min){
                        return ['payment' => false, 'price_id' => $config->id];
                    }

                    $payment = $config->min_value;
                    if ($type && $type > $config->min && $config->increase){
                        //$difference = $type - $config->min;
                        //$quotient = $this->getQuotient($type, $config->increase);
                        $payment += $type * $config->increase_value;
                    }

                    if ($request->receive && $config->address_payment && $config->address_receive){
                        $quotientAddress = $this->getQuotient($request->receive, $config->address_receive);
                        $payment += $quotientAddress*$config->address_payment;
                    }
                    $result = ($check) ? ['km' => $type, 'payment' => $payment, 'price_id' => $config->id] : ['payment' => $payment, 'price_id' => $config->id];
                    return $result;
                }
            }
            return false;

        }catch (\Exception $exception){
            logger(['service' => 'Get Payment Api', 'content' => $exception->getMessage()]);
            return false;
        }
    }
}