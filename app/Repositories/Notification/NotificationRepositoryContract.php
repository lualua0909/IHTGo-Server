<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 1:01 PM
 */

namespace App\Repositories\Notification;


use Illuminate\Http\Request;

interface NotificationRepositoryContract
{
    /**
     * @param array $condition
     * @param bool $first
     * @param array $select
     * @return mixed
     */
    public function findByCondition(array $condition, $first = true, $select = ['*']);
}