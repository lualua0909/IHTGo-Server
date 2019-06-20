<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 5/7/2018
 * Time: 9:52 AM
 */

namespace App\Http\Resources;


use App\Helpers\Business;

class DriverResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'order_id' => $this->id,
            'name' => $this->oName,
            'code' => $this->code,
            'car_id' => $this->cId,
            'car_name' => $this->cName,
            'car_number' => $this->number,
            'status' => $this->status,
            'total_price' => $this->total_price,
            'car_type' => $this->car_type,
            'car_option' => $this->car_option,
            'chatkit_id' => $this->chatkit_id,
            'typeCarName' => $this->handelTypeCarName($this->car_type),
            'typeOptionName' => $this->handelTypeOptionName($this->car_option),
            'statusName' => $this->handelStatusName($this->status),
            'created_at' => $this->convertDateToFormat('Y-m-d H:i:s', $this->created_at),
            'take_money' => $this->take_money,
            'payer' => $this->payer,
            'payerName' => $this->handelPayerName($this->payer),
            'speed' => $this->is_speed,
            'speedName' => $this->handelSpeed($this->is_speed),
        ];
    }


    /**
     * @param $payer
     * @return array|null|string
     */
    private function handelPayerName($payer)
    {
        switch ($payer){
            case Business::PAYER_RECEIVE:
                return __('label.payer_receive');
                break;
            case Business::PAYER_SENDER:
                return __('label.payer_sender');
                break;
            default:
                return __('label.undefined');
                break;
        }
    }

    /**
     * @param $speed
     * @return array|null|string
     */
    private function handelSpeed($speed)
    {
        switch ($speed){
            case Business::ORDER_UN_SPEED:
                return __('label.un_speed');
                break;
            case Business::ORDER_SPEED:
                return __('label.speed');
                break;
            default:
                return __('label.undefined');
                break;
        }
    }


    /**
     * @param $status
     * @return array|null|string
     */
    private function handelStatusName($status)
    {
        switch ($status){
            case Business::ORDER_STATUS_WAITING:
                return __('label.waiting');
                break;
            case Business::ORDER_STATUS_NO_DELIVERY:
                return __('label.no_delivery');
                break;
            case Business::ORDER_STATUS_BEING_DELIVERY:
                return __('label.being_delivery');
                break;
            case Business::ORDER_STATUS_DONE_DELIVERY:
                return __('label.done_delivery');
                break;
            case Business::ORDER_STATUS_CUSTOMER_CANCEL:
                return __('label.customer_cancel');
                break;
            case Business::ORDER_STATUS_IHT_CANCEL:
                return __('label.iht_cancel');
                break;
            default:
                return __('label.undefined');
                break;
        }
    }

    /**
     * @param $typeCar
     * @return array|null|string
     */
    private function handelTypeCarName($typeCar)
    {
        switch ($typeCar){
            case Business::CAR_TYPE_MOTORBIKE:
                return __('label.motorbike');
                break;
            case Business::CAR_TYPE_TRUCK:
                return __('label.truck');
                break;
            default:
                return __('label.undefined');
                break;
        }
    }

    /**
     * @param $typeOption
     * @return array|null|string
     */
    private function handelTypeOptionName($typeOption)
    {
        switch ($typeOption){
            case Business::PRICE_BY_TH1:
                return __('label.th1');
                break;
            case Business::PRICE_BY_TH2:
                return __('label.th2');
                break;
            case Business::PRICE_BY_TH3:
                return __('label.th3');
                break;
            default:
                return __('label.undefined');
                break;
        }
    }

}