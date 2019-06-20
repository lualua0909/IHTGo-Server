<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/10/18
 * Time: 09:49
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\Notification\NotificationRepositoryContract;

class NotificationController extends Controller
{

    private $repository;

    public function __construct(NotificationRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }



}