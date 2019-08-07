<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/28/18
 * Time: 16:48
 */

namespace App\Http\Controllers\Api\v1;


use App\Events\NewMessageNotification;
use App\Helpers\Business;
use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryContract;
use Chatkit\Laravel\ChatkitManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryContract $userRepositoryContract)
    {
        $this->user = $userRepositoryContract;
    }

    public function sendMsg(Request $request, ChatkitManager $chatkitManager)
    {
        try{
            $user = $request->user();
            $chatkitManager->sendMessage(['sender_id' => $user->chatkit_id, 'room_id' => $request->room_id, 'text' => $request->msg ]);
            event(new NewMessageNotification($request->msg, $user, $request->room_id));
            return response()->json(MessageApi::success('success'), HttpCode::SUCCESS);
        }catch (\Exception $exception){
            return response()->json(MessageApi::error([__('label.failed')]), HttpCode::SUCCESS);
        }
    }

    public function driver(Request $request)
    {
        $supports = $this->getSupport(Business::USER_SUPPORT_DRIVER, $request->user()->id);
        return response()->json(MessageApi::success($supports), HttpCode::SUCCESS);
    }

    public function customer(Request $request)
    {
        $supports = $this->getSupport(Business::USER_SUPPORT_CUSTOMER, $request->user()->id);
        return response()->json(MessageApi::success($supports), HttpCode::SUCCESS);
    }

    private function getSupport($support, $customerID)
    {
        $resultUser = DB::table('users as u')
            ->where(['u.support' => $support])
            ->select(['u.name', 'u.chatkit_id', 'id'])
            ->get();
        // $ids = $resultUser->pluck('id')->toArray();

        // $result = DB::table('contacts')
        //     ->where(function ($query) use ($ids, $customerID){
        //         $query->whereIn('user1_id', $ids)
        //             ->where(['user1_id' => $customerID])
        //             ->orWhere(['user2_id' => $customerID]);
        //     })
        //     ->orWhere(function ($query) use ($ids, $customerID){
        //         $query->whereIn('user2_id', $ids)
        //             ->where(['user1_id' => $customerID])
        //             ->orWhere(['user2_id' => $customerID]);
        //     })
        //     ->select('room_id', 'user1_id', 'user2_id')
        //     ->get();
        // $results = $resultUser->toArray();
        // foreach ($result as $item){
        //     if (in_array($item->user1_id, $ids)){
        //         $key = array_search($item->user1_id, $ids);
        //         $results[$key]->room_id = $item->room_id;
        //     }if (in_array($item->user2_id, $ids)){
        //         $key = array_search($item->user2_id, $ids);
        //         $results[$key]->room_id = $item->room_id;
        //     }
        // }
        return $resultUser;
    }
}