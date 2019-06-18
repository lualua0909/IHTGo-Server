<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 9/28/18
 * Time: 16:39
 */

namespace App\Services;

use App\Helpers\Business;
use App\Models\Order;
use WebSocket\Client;
use WebSocket\Exception;
class SocketChat
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * SocketClient constructor.
     */
    public function __construct()
    {
        $webSocket = 'ws://' . config('app.websocket') . '/chat';
        $this->client= new Client($webSocket, [
            'timeout' => 10,
            'headers' => [
                'author' => 'IHT'
            ]
        ]);
    }

    /**
     * @param string $msg
     * @return bool
     */
    private function sendMsgToServer($msg='')
    {
        try{
            $this->client->send($msg,'text',  true);
            $this->client->close();
            return true;
        }catch (Exception $exception){
            logger($exception->getMessage());
            return false;
        }
    }

    /**
     * @param $name
     * @param $msg
     * @return bool
     */
    public function msgChat($name, $msg)
    {
        return $this->sendMsgToServer(json_encode(['message' => $msg, 'name' => $name]));
    }
}