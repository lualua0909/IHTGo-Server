<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/28/18
 * Time: 16:48
 */

namespace App\Http\Controllers\Api\v1;


use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use App\Http\Controllers\Controller;
use App\Services\SocketChat;
use Chatkit\Laravel\ChatkitManager;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $socket;

    public function __construct()
    {
        $this->socket = new SocketChat();
    }

    public function sendMsg(Request $request, ChatkitManager $chatkitManager)
    {
        try{
            $user = $request->user();
            $chatkitManager->sendMessage(['sender_id' => $user->chatkit_id, 'room_id' => $request->room_id, 'text' => $request->msg ]);
            if ($this->socket->msgChat($request->user()->name, $request->msg)){
                return response()->json(MessageApi::success('success'), HttpCode::SUCCESS);
            }
            return response()->json(MessageApi::error([__('label.failed')]), HttpCode::SUCCESS);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }
}