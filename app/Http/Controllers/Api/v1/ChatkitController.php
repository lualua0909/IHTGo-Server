<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 8/29/18
 * Time: 14:26
 */

namespace App\Http\Controllers\Api\v1;


use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use App\Http\Controllers\Api\ApiController;
use App\Models\Contact;
use App\Models\Room;
use App\User;
use Chatkit\Laravel\ChatkitManager;
use Illuminate\Http\Request;

class ChatkitController extends ApiController
{
    public function createUser(Request $request, ChatkitManager $chatkitManager)
    {
        $user = $request->user();
        dd($user);
        $userData = ['id' => '"' . $user->id . '"', 'name' => $user->name];
        $chatkitManager->createUser($userData);

        $roomData = ['creator_id' => '"' . $user->id . '"', 'name' => $user->name];
        dd($chatkitManager->createRoom($roomData));
    }

    public function getContact($id, Request $request)
    {
        $contacts = [];
        $me = User::select(['id'])->find($id);
        // Loop through the contacts and format each one
        Contact::for($me->id)->get()->each(function ($contact) use ($me, &$contacts) {
            $friend = $contact->user1_id == $me->id ? $contact->user2 : $contact->user1;
            $contacts[] = $friend->toArray() + ['room' => $contact->room->toArray()];
        });

        return response()->json($contacts);
    }

    public function postContact(Request $request, ChatkitManager $chatkitManager)
    {
        try{
            $user = $request->user();

            $data = $this->validateData($request, ['chatkit_id' => "required|not_in:{$user->chatkit_id}|exists:users,chatkit_id"]);
            if (!is_array($data)) {
                return $data;
            }

            $friend = User::where(['chatkit_id' => $request->chatkit_id])->first();
            $response = $chatkitManager->createRoom([
                'creator_id' => $user->chatkit_id,
                'private' => true,
                'name' => $this->generate_room_id($user, $friend),
                'user_ids' => [$user->chatkit_id, $friend->chatkit_id],
            ]);

            if ($response['status'] !== 201) {
                return response()->json(['status' => 'error'], 400);
            }

            $room = Room::create($response['body']);

            $contact = Contact::create([
                'user1_id' => $user->id,
                'user2_id' => $friend->id,
                'room_id' => $room->id
            ]);

            return response()->json(MessageApi::success($room->id));
        }catch (\Exception $exception){
            logger($exception->getMessage());
            return response()->json(MessageApi::error(['error' => 'create room fail'], HttpCode::CODE_STATUS_CREATE_ROOM_FAIL), HttpCode::SUCCESS);
        }

    }

    private function generate_room_id(User $user, User $user2) : string
    {
        $chatkit_ids = [$user->chatkit_id, $user2->chatkit_id];
        sort($chatkit_ids);
        return md5(implode('', $chatkit_ids));
    }

    public function getToken(Request $request, ChatkitManager $chatkit)
    {
        $auth_data = $chatkit->authenticate([
            'user_id' => $request->user()->chatkit_id
        ]);

        return response()->json(
            $auth_data['body'],
            $auth_data['status']
        );
    }

    public function message($id, Request $request, ChatkitManager $chatkitManager)
    {
        $user = User::find($id);
        $data = $this->validateData($request, ['text' => "required", 'room_id' => 'required|exists:rooms,id']);
        if (!is_array($data)) {
            return $data;
        }
        try{
            $chatkitManager->sendMessage(['sender_id' => $user->chatkit_id, 'room_id' => $request->room_id, 'text' => $request->text ]);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }

    public function getMessage(Request $request, ChatkitManager $chatkitManager)
    {
        $data = $this->validateData($request, ['room_id' => 'required|exists:rooms,id']);
        if (!is_array($data)) {
            return $data;
        }
        try{
            $message = $chatkitManager->getRoomMessages(['limit' => 30, 'room_id' => $request->room_id, 'direction' => 'older']);
            if ($message['status'] == 200){
                return response()->json($message['body']);
            }
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }
}