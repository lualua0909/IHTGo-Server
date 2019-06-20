<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 6/17/18
 * Time: 18:03
 */

namespace App\Helpers;


class Business
{
    const PAGE_SIZE = 10;

    const USER_ACTIVE = 1;
    const USER_UN_ACTIVE = 0;

    const USER_SUPPORT_DRIVER = 1;
    const USER_SUPPORT_CUSTOMER = 2;

    const PUBLISH = 1;
    const UN_PUBLISH = 0;

    const ORDER_SPEED = 1;
    const ORDER_UN_SPEED = 0;
    const ORDER_SPEED_PAYMENT = 2;

    const USER_BANED = 1;
    const USER_UN_BANED = 0;

    const COLLECTION_DEPT_WAITING = 1;
    const COLLECTION_DEPT_DONE = 2;
    const COLLECTION_DEPT_FAILED = 3;

    const USER_LEVEL_ADMIN = 1;
    const USER_LEVEL_EMPLOYEE = 2;
    const USER_LEVEL_CUSTOMER = 3;
    const USER_LEVEL_DRIVER = 4;

    const CUSTOMER_TYPE_USER = 1;
    const CUSTOMER_TYPE_COMPANY = 2;

    const CAR_TYPE_USER = 1;
    const CAR_TYPE_COMPANY = 2;

    const CAR_TYPE_MOTORBIKE = 1;
    const CAR_TYPE_TRUCK = 2;
    //const CAR_TYPE_TRUCK_500 = 2;
    //const CAR_TYPE_TRUCK_1000 = 3;

    //social
    const CUSTOMER_SOCIAL_FACEBOOK = 'facebook';
    const CUSTOMER_SOCIAL_GOOGLE = 'google';

    const OTHER_TYPE_SERVICE = 1;
    const OTHER_TYPE_DRIVE = 2;
    const OTHER_TYPE_CUSTOMER = 3;
    const OTHER_TYPE_CAR = 4;

    const SERVICE_TYPE_INTERNAL = 1;
    const SERVICE_TYPE_PUBLIC = 2;

    const EVALUATE_TYPE_SERVICE = 1;
    const EVALUATE_TYPE_DRIVE = 2;
    const EVALUATE_TYPE_CUSTOMER = 3;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const PAYER_RECEIVE = 1;
    const PAYER_SENDER = 2;

    // Finance
    const FINANCE_TYPE_IN = 1;
    const FINANCE_TYPE_OUT = 2;

    // Notification
    const NOTIFICATION_TYPE_CHAT = 1;
    const NOTIFICATION_TYPE_ORDER = 2;

    const ORDER_STATUS_WAITING = 1;
    const ORDER_STATUS_NO_DELIVERY = 2;
    const ORDER_STATUS_BEING_DELIVERY = 3;
    const ORDER_STATUS_DONE_DELIVERY = 4;
    const ORDER_STATUS_CUSTOMER_CANCEL = 5;
    const ORDER_STATUS_IHT_CANCEL = 6;
    const ORDER_STATUS_FAIL = 7;
    const ORDER_STATUS_GET = 8;
    const ORDER_STATUS_PAYMENT = 1;
    const ORDER_STATUS_NO_PAYMENT = 0;
    const ORDER_STATUS_PAYMENT_DEPT = 2;

    // Order Delivery
    const ORDER_DELIVERY_GIAO = 1;
    const ORDER_DELIVERY_BEING = 2;
    const ORDER_DELIVERY_DONE = 3;
    const ORDER_DELIVERY_FAIL = 4;

    const PAYMENT_METHOD_CASH = 1;
    const PAYMENT_METHOD_MONTH = 2;
    const PAYMENT_METHOD_OTHER = 3;

    const PAYMENT_DONE = 1;
    const PAYMENT_DEPT = 2;

    const SETTING_MONEY_BY_KM = 1;
    const SETTING_MONEY_BY_WEIGHT = 2;
    const PRICE_BY_TH1 = 1;
    const PRICE_BY_TH2 = 2;
    const PRICE_BY_TH3 = 3;
    const SETTING_PRICE = 'price';
    const SETTING_SURTAX = 'surtax';

    // image
    const IMAGE_UPLOAD_TYPE_AVATAR = 'avatar';
    const IMAGE_UPLOAD_TYPE_ORDER = 'order';

    // msg socket
    const SOCKET_NEW_ORDER = 'Đơn hàng mới. <br /> Khách hàng %s vừa đặt đơn hàng <a target="_blank" href="%s">%s</a>';
    const SOCKET_NEW_CUSTOMER = 'Khách hàng mới. <br /> %s vừa đăng kí tài khoản <a target="_blank" href="%s">%s</a>';
    const SOCKET_CANCEL_ORDER = 'Hủy đơn hàng. <br /> Khách hàng %s vừa hủy đơn hàng <a target="_blank" href="%s">%s</a>';
    const SMS_ACTIVATED_ACCOUNT = 'Vui long nhap ma sau de kich hoat tai khoan <%1$s> . Tin nhan duoc gui tu %2$s. Tks!';
    const SMS_RESET_PASSWORD = 'Mat khau cua ban vua thay doi thanh <%1$s> . Tin nhan duoc gui tu %2$s';

    //FCM
    const FCM_CUSTOMER_STATUS = 'Đơn hàng <%1$s> của bạn đang được xử lý <%2$s>';
    const FCM_DRIVER_ORDER = 'Bạn vừa được phân công phụ trach đơn hàng <%1$s>';
    const FCM_ORDER_TITLE = 'Thông báo đơn hàng';
    const FCM_DEPT_DRIVER = 'Bạn vừa được phân công phụ trach thu tien ho <%1$s>';

    // google link get info start and end
    const GOOGLE_URL_GET_INFO = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=%1$s&destinations=%2$s';

    const LOG_FORMAT = '[dd-mm-Yyyy H:i:s][LOG-TYPE][CURRENT-USER][SCREEN-NAME][ACTION][MESSAGE]';
}