<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 27/6/2018
 * Time: 11:11 AM
 */

namespace App\Http\Resources;


use App\Helpers\Business;
use App\Models\Customer;
use App\Models\Data\District;
use App\Models\Data\Other;
use App\Models\Data\Province;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class OrderResource extends BaseResource
{
    public function toArray($request)
    {
        $chatkit = $this->getChatkitId($this->id);
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'car_type' => $this->car_type,
            'car_option' => $this->car_option,
            'total_price' => $this->total_price,
            'payment_type' => $this->payment_type,
            'is_payment' => $this->is_payment,
            'created_at' => $this->convertDateToFormat('Y-m-d H:i:s', $this->created_at),
            'status' => $this->status,
            'statusName' => $this->handelStatusName($this->status),
            'typeCarName' => $this->handelTypeCarName($this->car_type),
            'typeOptionName' => $this->handelTypeOptionName($this->car_option),
            'take_money' => $this->take_money,
            'payer' => $this->payer,
            'user_id' => $this->user_id,
            'payerName' => $this->handelPayerName($this->payer),
            'speed' => $this->is_speed,
            'speedName' => $this->handelSpeed($this->is_speed),
            'detail' => (isset($this->detail)) ? $this->detail : null,
            'receive' => (isset($this->receive)) ? $this->receive : null,
            'image' => (isset($this->images)) ? $this->getImage($this->images) : $this->getImageShowList($this->id),
            'driver_id' => ($this->status != Business::ORDER_STATUS_WAITING) ? optional($chatkit)->driver_id : null,
            'chatkit_id' => ($this->status != Business::ORDER_STATUS_WAITING) ? optional($chatkit)->chatkit_id : null,
            'customerChatkit' => isset($this->customer) ? $this->customer->chatkit_id : null,
            'room_id' => ($this->status != Business::ORDER_STATUS_WAITING) ? (($chatkit) ? $this->getRoomId(optional($chatkit)->id, $this->user_id) : null) : null,
            'sender_province_name' => (isset($this->detail)) ? $this->getProvinceName($this->detail->sender_province_id) : $this->sender_province_name,
            'receive_province_name' => (isset($this->detail)) ? $this->getProvinceName($this->detail->receive_province_id) : $this->receive_province_name,
            'receive_district_name' => (isset($this->detail)) ? $this->getDistrictName($this->detail->receive_district_id) : $this->receive_district_name,
            'sender_district_name' => (isset($this->detail)) ? $this->getDistrictName($this->detail->sender_district_id) : $this->sender_district_name,

        ];
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
            case Business::ORDER_STATUS_FAIL:
                return __('label.order_fail');
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
     * @param $typeCar
     * @return array|null|string
     */
    private function handelTypeCarName($typeCar)
    {
        $types = Other::where(['type' => Business::OTHER_TYPE_CAR])->get(['id', 'name'])->pluck('name', 'id')->toArray();
        if (array_key_exists($typeCar, $types)){
            return $types[$typeCar];
        }
        return __('label.undefined');
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
     * @param $orderID
     * @return null|string
     */
    private function getImageShowList($orderID)
    {
        $imageId = Image::select('id')->where(['service_id' => $orderID, 'type' => Business::IMAGE_UPLOAD_TYPE_ORDER])->orderBy('position', 'DESC')->first();
        if ($imageId){
            return route('api.image.show', ['id' => $imageId, 'type' => Business::IMAGE_UPLOAD_TYPE_ORDER]);
        }
        return null;
    }

    /**
     * @param $orderID
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    private function getChatkitId($orderID)
    {
        $result = DB::table('deliveries as d')
            ->leftJoin('drivers as dr', 'dr.id', '=', 'd.driver_id')
            ->leftJoin('users as u', 'u.id', '=', 'dr.user_id')
            ->where(['d.order_id' => $orderID])
            ->select('u.chatkit_id', 'u.id', 'd.driver_id')
            ->first();
        return $result;
    }

    /**
     * @param $driverID
     * @param $customerID
     * @return mixed|null
     */
    private function getRoomId($driverID, $customerID)
    {
        if ($driverID){
            $result = DB::table('contacts')
                ->where(function ($query) use ($driverID, $customerID){
                    $query->where(['user1_id' => $driverID, 'user2_id' => $customerID]);
                })
                ->orWhere(function ($query) use ($driverID, $customerID){
                    $query->where(['user2_id' => $driverID, 'user1_id' => $customerID]);
                })
                ->value('room_id');
            if ($result){
                return $result;
            }
        }
        return null;
    }

    private function getProvinceName($provinceID)
    {
        return Province::where(['province_id' => $provinceID])->value('name');
    }

    private function getDistrictName($districtID)
    {
        return District::where(['id' => $districtID])->value('name');
    }
}