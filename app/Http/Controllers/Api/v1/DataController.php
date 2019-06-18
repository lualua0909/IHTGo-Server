<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 6/23/18
 * Time: 21:20
 */

namespace App\Http\Controllers\Api\v1;


use App\Helpers\Business;
use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\BaseResource;
use App\Http\Resources\OtherResource;
use App\Models\Data\District;
use App\Models\Data\Other;
use App\Models\Data\Province;
use App\Models\Device;
use App\Services\DownstreamMessageToDevice;
use Illuminate\Http\Request;

class DataController extends ApiController
{
    public function province(Province $province)
    {
        return new BaseResource(optional($province->where(['publish' => 1])->get()));
    }

    public function district(District $district)
    {
        return new BaseResource(optional($district->where(['publish' => 1])->get()));
    }

    public function districtBinhDuong(District $district)
    {
        return new BaseResource(optional($district->where(['province_id' => 74])->get()));
    }

    public function other(Other $other)
    {
        return OtherResource::collection(optional($other->all()))->additional(['success' => HttpCode::SUCCESS, 'error_code' => HttpCode::CODE_SUCCESS]);
    }

    public function noti(DownstreamMessageToDevice $messageToDevice)
    {
        $token = "faCdrYmJz3Q:APA91bH2L9BJlbagsHyXN7ITk_38dLsfZAA5FRS6yeu-sMtH0u0T02R6cw6hkmhWCxSxAwPhQel5nK6m2c6rtau1F-qM5WlUF-vq7-HGCCcGyR0xhtmn2NaZaB4F5hRV3NpiCnRR5-xu";
        dd($messageToDevice->sendMsgToDevice($token));
    }

    public function device(Request $request, Device $device)
    {
        $userId = $request->user()->id;
        $device->where(['user_id' => $userId])->delete();
        $data = $request->only('fcm','device_id','device_name','os','app_version');
        $data['user_id'] = $userId;
        if ($device->create($data)){
            return response()->json(MessageApi::success([]));
        }
        return response()->json(MessageApi::error([MessageApi::ITEM_DOES_NOT_EXISTS]), HttpCode::SUCCESS);
    }

    public function typeCar(Other $other)
    {
        return new BaseResource(optional($other->select(['id', 'name'])->where(['type' => Business::OTHER_TYPE_CAR])->get()));
    }

    public function districtBinhDuongAll()
    {

    }
}