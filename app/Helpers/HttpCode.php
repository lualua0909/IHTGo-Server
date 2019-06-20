<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 8/1/2018
 * Time: 2:13 PM
 */

namespace App\Helpers;

class HttpCode
{
    const FAILED = 100;
    const SUCCESS = 200;
    const WARNING = 300;

    const COULD_NOT_CREATE_TOKEN = 1000;

    const CODE_IN_VERIFY = 1;
    const CODE_IN_ACTIVATED = 2;
    const CODE_BANED = 3;


    // Common
    const CODE_ERROR_SYSTEM = -1;
    const ITEM_NOT_EXISTS = 1010;
    const CREATE_ITEM_ERROR = 1001;
    const CODE_UPDATE_ERROR = 1002;
    const CODE_VALIDATE_IN_VALID = 1003;
    const CODE_METHOD_NOT_ALLOW = 1004;
    const CODE_PAGE_NOT_EXISTS = 1005;
    const CODE_STATUS_ORDER_ERROR = 1006;
    const CODE_STATUS_ORDER_ERROR_PAYMENT = 1007;
    const CODE_STATUS_ORDER_BIG_PAYMENT = 1008;
    const CODE_STATUS_CREATE_ROOM_FAIL = 1009;
    const CODE_SUCCESS = 0;
}