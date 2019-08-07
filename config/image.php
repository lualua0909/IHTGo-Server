<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    'avatar_height' => 128,
    'avatar_width' => 128,
    'avatar_folder' => 'AVATAR/',

    'order_height' => 370,
    'order_width' => 280,
    'order_folder' => 'ORDER/',

    'image_folder' => [
        'order',
        'avatar'
    ]

];
