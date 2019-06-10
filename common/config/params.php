<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'WECHAT' => [// invoked by maxwen\easywechat\Wechat
        'debug' => YII_DEBUG,
        //        'app_id' => 'wx75c1d105b1fd1ffd',  // live site app id， 子弹头照明北欧时尚私享馆服务号
        //        'secret' => '879b5c1c65064147211be99cec3f9752',  // live site app secret， 子弹头照明北欧时尚私享馆服务号
        //        'token' => 'jXqrAxLmMUhfFQLeIWhQMQeW2MLFgQZQ',  // live site token， 子弹头照明北欧时尚私享馆服务号
        //        'app_id' => 'wx05c38703ea5f50bc',  // staging site app id， 测试公众号（wxid_d5r4frk5z0fk21）
        //        'secret' => 'a6faf24a1be907c9dd195b12b2a2858e',   // staging site app secret， 测试公众号（wxid_d5r4frk5z0fk21）
        //        'token' => 'jXqrAxLmMUhfFQLeIWhQMQeW2MLFgQZQ',  // staging site token， 测试公众号（wxid_d5r4frk5z0fk21）
        // 'app_id' => 'wx936b06f7a8c3a4bd', // staging site app id， 测试服务号（子弹头工程渠道）
        'app_id' => 'wx800f20ef912854ac', // staging site app id， 测试服务号（子弹头工程渠道）
        // 'secret' => 'f54470c648586cf00643dbb5ff5c951f', // staging site app secret， 测试服务号（子弹头工程渠道）
        'secret' => '8ec23e28261dbb495db666c371cdd02f', // staging site app secret， 测试服务号（子弹头工程渠道）
        // 'token' => 'omJNpZEhZeHj1ZxFECKkP48B5VFbk1HP', // staging site token， 测试服务号（子弹头工程渠道）
        'token' => 'jXqrAxLmMUhfFQLeIWhQMQeW2MLFgQZQ', // staging site token， 测试服务号（子弹头工程渠道）
        // 'aes_key' => '0KdNhF9xlQqmZpQgdnkU8Y0qditPQNjloZBvqEVQtJy',
        'aes_key' => 'rIpTTuiMPNyoynCYNhYCGBMikuYzkmgVrmBDoIhmIIU',
        'payment' => [
            'merchant_id' => '1525973221', // 子弹头工程渠道商户号
            'key' => 'HltDQ9wR0FRV4350f1EBxAUaaqb9UfKD', // 子弹头工程渠道商户平台API密匙
            //            'merchant_id' => '1472507702', // 子弹头照明北欧时尚私享馆商户号
            //            'key' => 'zsdvfawegg52qdf42342dfcser12dzqg', //子弹头照明北欧时尚私享馆商户平台API密匙
            'cert_path' => __DIR__ . '/certs/apiclient_cert.pem',
            'key_path' => __DIR__ . '/certs/apiclient_key.pem',
            'notify_url' => FRONTEND_BASE_URL . 'wechat/default/payment-notify', // 你也可以在下单时单独设置来想覆盖它
            // 'device_info'     => '013467007045764',
            // 'sub_app_id'      => '',
            // 'sub_merchant_id' => '',
        ],
        //        'log' => [
        //            'level' => 'debug',
        //            'file' => APP_ROOT . '/runtime/logs/wechat.log',
        //        ],
    ],
    'config' => [
        'languages' => ['en', 'zh-CN'],
        'beBaseUrl' => BACKEND_BASE_URL,
        'feBaseUrl' => FRONTEND_BASE_URL,
        'eshopBaseUrl' => ESHOP_BASE_URL,
        'feUser' => [
            'authorizeUrl' => FRONTEND_BASE_URL . '/authorize',
            'uploadPath' => '@runtime/uploads/temp/user',
        ],
        'shop' => [
            'uploadPath' => '@runtime/uploads/temp/shop',
        ],
        'admin' => [
            'email' => 'admin@zdt6.com',
            'algorithm' => 'sha1',
        ],
        'upload' => [// config system upload files folder, including products/topics/articles... related files
            //            'accessUrl' => '/uploads/store',
            //            'storePath' => '@frontend/web/uploads/store',
            'accessUrl' => IMAGE_BASE_URL . '/store',
            'storePath' => '@appimage/store',
            'tempPath' => '@runtime/uploads/temp',
            'imageWhiteExts' => ['gif', 'png', 'jpg', 'jpeg'],
            'fileWhiteExts' => ['mp4', 'swf', 'zip', 'pdf', 'doc', 'docx', 'xlsx', 'txt'],
            'maxFileSize' => 2097152, // 2MB
            'maxFiles' => 10, // Allow to upload maximum files, default to 5
        ],
        'pagination' => [
            'pageSize' => 20,
        ],
        //        'userdata' => [// config customer/member users' related file folder, including user's album/order... files
        //            'path' => 'userdata', // save under webroot
        //            'maxFileSize' => "200mb",
        //        ],
        //        'currency' => [// default currency, if not set local currency
        //            'code' => 'CNY',
        //        ],
        //        'geo' => [
        //            'enable' => true,
        ////            'defaultLatLng' => ["22.3964280000", "114.1094970000"], // default latitude and longitude is HongKong China
        //            'defaultLatLng' => ["23.1291630000", "113.2644350000"], // default latitude and longitude is GuangZhou China
        //        ],
        //        // Common JqueryUi Widget preferences:
        //        'juiPrefs' => [
        //            'themePath' => '/css/jui',
        //            'theme' => 'ui-lightness', // 'smoothness'
        //        ],

        'api' => [
            'secret' => '5955418f95abae997be50efeb5c0cd98',
        ]
    ],
];
