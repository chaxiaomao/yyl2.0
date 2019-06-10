<?php
return [
    'adminEmail' => 'admin@example.com',
    'wechat' => [
        'code' => 'SC-YYL-02',
        'authReturnUrl' => FRONTEND_BASE_URL, // authorized url
        'hostUrl' => FRONTEND_BASE_URL,
        'returnRoute' => '/',
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
];
