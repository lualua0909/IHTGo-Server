<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 4/7/2018
 * Time: 11:01 AM
 */

namespace App\Services;


use App\Helpers\Business;
use App\Models\Order;
use WebSocket\Client;
use WebSocket\Exception;

class SocketClient
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
        $webSocket = 'ws://' . config('app.websocket') . '/server';
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
     * @param Order $order
     * @return bool
     */
    public function msgNewOrder(Order $order)
    {
        $msg = sprintf(Business::SOCKET_NEW_ORDER, $order->customer->name, route('order.detail', $order->id), $order->name);
        return $this->sendMsgToServer(json_encode(['content' => $msg, 'type' => 'success']));
    }

    /**
     * @param Order $order
     * @return bool
     */
    public function msgCancelOrder(Order $order)
    {
        $msg = sprintf(Business::SOCKET_CANCEL_ORDER, $order->customer->name, route('order.detail', $order->id), $order->name);
        return $this->sendMsgToServer(json_encode(['content' => $msg, 'type' => 'warning']));
    }
}