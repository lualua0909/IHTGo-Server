<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 9:47 AM
 */

namespace App\Repositories\Setting;

use App\Models\Setting;
use App\Repositories\EloquentRepository;

class SettingRepository extends EloquentRepository implements SettingRepositoryContract
{
    public function getModel()
    {
        return Setting::class;
    }

    public function findSettingByCondition(array $condition)
    {
        return $this->_model->where($condition)->get();
    }
}