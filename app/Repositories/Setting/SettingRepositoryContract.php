<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 9:47 AM
 */

namespace App\Repositories\Setting;


interface SettingRepositoryContract
{
    public function findSettingByCondition(array $condition);
}