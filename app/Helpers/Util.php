<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 6/17/18
 * Time: 19:40
 */

namespace App\Helpers;


use Carbon\Carbon;

class Util
{
    public static function showCreatedAt($time, $toFormat='H:i:s d-m-Y', $fromFormat = 'Y-m-d H:i:s')
    {
        if ($time){
            return Carbon::createFromFormat($fromFormat, $time)->format($toFormat);
        }
        return null;
    }
}