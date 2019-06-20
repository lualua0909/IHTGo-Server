<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/10/18
 * Time: 10:22
 */

namespace App\Http\Controllers\Api\v1;


use App\Helpers\Business;
use App\Helpers\MessageApi;
use App\Http\Controllers\Api\ApiController;
use App\Repositories\Notification\NotificationRepositoryContract;
use Illuminate\Http\Request;

class NotificationController extends ApiController
{
    private $repository;

    public function __construct(NotificationRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    public function chat()
    {
        $notifications = $this->repository->findByCondition(['type' => Business::NOTIFICATION_TYPE_CHAT, 'read' => null], false, ['url', 'content', 'id']);
        return response()->json(['notifications' => $notifications], 200);
    }

    public function order()
    {
        $notifications = $this->repository->findByCondition(['type' => Business::NOTIFICATION_TYPE_ORDER, 'read' => null], false, ['url', 'content', 'id']);
        return response()->json(['notifications' => $notifications], 200);
    }

    public function store(Request $request)
    {
        $notification = $this->repository->findByCondition(['url' => $request->url, 'read' => null], true, ['id']);
        if (!$notification){
            if ($this->repository->store($request->only('url', 'type', 'content', 'to_id'))){
                return response()->json(MessageApi::success('success'), 200);
            }
            return response()->json(MessageApi::error(['failed']), 200);
        }
    }

    public function read($id)
    {
        if ($this->repository->update($id, ['read' => date('Y-m-d H:i:s')])){
            return response()->json(MessageApi::success('success'), 200);
        }
        return response()->json(MessageApi::error(['failed']), 200);
    }
}