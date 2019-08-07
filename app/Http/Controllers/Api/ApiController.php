<?php

/**
 * Created by PhpStorm.
 * User: thai
 * Date: 8/1/2018
 * Time: 11:19 AM
 */

namespace App\Http\Controllers\Api;

use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function validateData(Request $request, array $rules)
    {

        $input = $request->all();
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(MessageApi::error($validator->errors()->all(), HttpCode::CODE_VALIDATE_IN_VALID), HttpCode::SUCCESS);
        } else {
            return $input;
        }
    }

    protected function getCurrentTimestamp()
    {
        return Carbon::now()->timestamp;
    }
    //raymond
    public function loadInfoSender(Request $req)
    {
        try {
            $data = Order::loadInfoSender($req);
            return response()->json(['data' => $data, 'code' => 200]);
        } catch (\Exception $e) {
            return response()->json(['code' => 500]);
        }
    }
    public function loadInfoReceive(Request $req)
    {
        try {
            $data = Order::loadInfoReceive($req);
            return response()->json(['data' => $data, 'code' => 200]);
        } catch (\Exception $e) {
            return response()->json(['code' => 500]);
        }
    }
}
