<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/22/18
 * Time: 07:18
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Room;
use App\User;
use Chatkit\Laravel\Facades\Chatkit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index($id=null, Request $request)
    {
        $title = 'Hỗ trợ';
        $listUser = User::whereIn('level', [Business::USER_LEVEL_EMPLOYEE, Business::USER_LEVEL_CUSTOMER])->select(['id', 'chatkit_id', 'name', 'level'])->get();
        list($listCustomer, $listDriver) = $listUser->partition(function ($user) {
            return $user->level == Business::USER_LEVEL_CUSTOMER;
        });

        $friend = ($id) ? User::find($id) : false;
        $roomID = ($id) ? $this->findOrCreateRoom($request->user()->id, $friend) : false;
        $listMessage = ($roomID) ? array_reverse($this->getMsg($roomID)) : [];

        //if($listMessage) dd($listMessage);
        return view('admin.chat.list', compact('friend', 'title', 'listDriver', 'listCustomer', 'roomID', 'listMessage'));
    }

    private function create($user1, $userChat2)
    {
        try{
            $userChat1 = User::select('chatkit_id', 'id')->find($user1);
            $response = Chatkit::createRoom([
                'creator_id' => $userChat1->chatkit_id,
                'private' => true,
                'name' => $this->generateRoomId($userChat1, $userChat2),
                'user_ids' => [$userChat1->chatkit_id, $userChat2->chatkit_id],
            ]);
            if ($response['status'] !== 201) {
                return false;
            }

            $room = Room::create($response['body']);

            Contact::create(['user1_id' => $userChat1->id, 'user2_id' => $userChat2->id, 'room_id' => $room->id]);
            return $room->id;
        }catch (\Exception $exception){
            logger(['service' => 'chatkit new room', 'content' => $exception->getMessage()]);
            return false;
        }

    }

    private function findOrCreateRoom($user1, $user2)
    {
        $result = DB::table('contacts as c')
            ->select('c.room_id')
            ->where(['user1_id' => $user1, 'user2_id' => $user2->id])
            ->orWhere(['user2_id' => $user1, 'user1_id' => $user2->id])
            ->first();
        if ($result){
            return $result->room_id;
        }

        return $this->create($user1, $user2);
    }

    private function generateRoomId(User $user, User $user2) : string
    {
        $chatkit_ids = [$user->chatkit_id, $user2->chatkit_id];
        sort($chatkit_ids);
        return md5(implode('', $chatkit_ids));
    }

    private function getMessage($roomID)
    {
        dd(route('api.chat.getMessage'));
        try{
            $param = array(
                'room_id' => $roomID
            );
            $ch = curl_init(route('api.chat.getMessage'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, count($param));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
            $result = curl_exec($ch);
            curl_close($ch);
            dd($result);
            echo $result;
        }catch (\Exception $exception){
            logger(['service' => 'chatkit get msg', 'content' => $exception->getMessage()]);
            return false;
        }
    }

    private function getMsg($roomId)
    {
        try{
            $msg = Chatkit::getRoomMessages(['limit' => 30, 'room_id' => $roomId, 'direction' => 'older']);
            if ($msg['status'] == 200){
                return $msg['body'];
            }
        }catch (\Exception $exception){
            logger(['service' => 'chatkit get msg', 'content' => $exception->getMessage()]);
            return false;
        }
    }
}