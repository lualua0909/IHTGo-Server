<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 8/1/2018
 * Time: 2:09 PM
 */

namespace App\Helpers;

class MessageApi
{
    const ITEM_DOES_NOT_EXISTS = 'Item dose not exist';
    const UPLOAD_IMAGE_FAILED = 'Upload image failed';
    const SOMETHING_WRONG = 'Something went wrong';

    public static function success($data): array
    {
        return [
            'status' => HttpCode::SUCCESS,
            'error_code' => HttpCode::CODE_SUCCESS,
            'data'    => ($data) ? $data : [],
        ];
    }

    public static function error(array $data, $errorCode = HttpCode::CODE_VALIDATE_IN_VALID): array
    {
        return [
            'status' => HttpCode::SUCCESS,
            'error_code' => $errorCode,
            'message' => ($data) ? $data : [],
        ];
    }
}