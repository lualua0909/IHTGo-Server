<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 22/6/2018
 * Time: 1:01 PM
 */

namespace App\Repositories\Notification;


use App\Helpers\Business;
use App\Models\Notification;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationRepository extends EloquentRepository implements NotificationRepositoryContract
{
    /**
     * @return string
     */
    public function getModel()
    {
        return Notification::class;
    }

    public function findByCondition(array $condition, $first = true, $select = ['*'])
    {
        // TODO: Implement findByCondition() method.
        if ($first){
            return $this->_model->select($select)->where($condition)->first();
        }
        return $this->_model->select($select)->where($condition)->get();
    }


}