<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 8/29/18
 * Time: 14:22
 */

namespace App\Services;


use Chatkit\Laravel\ChatkitManager;
use Chatkit\Laravel\Facades\Chatkit;

class ChatkitService
{
    public function startChatting()
    {
        $id = time();
        try{
            Chatkit::createUser(['id' => "$id", 'name' => 'ThaiLe' . time()]);
            Chatkit::createRoom(['creator_id' => "$id", 'name' => 'LeThai' . time()]);
            Chatkit::sendMessage(['sender_id' => "$id", 'room_id' => 'r001', 'text' => 'Hi, everyone!' ]);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }

    }

    private function manager(ChatkitManager $chatkitManager)
    {
        $chatkitManager->createUser();
    }
}