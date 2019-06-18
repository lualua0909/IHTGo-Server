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
            'detail' => (isset($this->detail)) ? $this->detail : null,
            'receive' => (isset($this->receive)) ? $this->receive : null,
            'image' => (isset($this->images)) ? $this->getImage($this->images) : $this->getImageShowList($this->id),
            'driver_id' => ($this->status != Business::ORDER_STATUS_WAITING) ? optional($chatkit)->driver_id : null,
            'chatkit_id' => ($this->status != Business::ORDER_STATUS_WAITING) ? optional($chatkit)->chatkit_id : null,
            'room_id' => ($this->status != Business::ORDER_STATUS_WAITING) ? (($chatkit) ? $this->getRoomId(optional($chatkit)->id, $this->user_id) : null) : null,
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

    private function getRoomId($driverID, $customerID)
    {
        if ($driverID){
            $result = DB::table('contacts')
                ->where(['user1_id' => $driverID, 'user2_id' => $customerID])
                ->orWhere(['user2_id' => $driverID, 'user1_id' => $customerID])
                ->value('room_id');
            if ($result){
                return $result;
            }
        }
        return null;
    }
}