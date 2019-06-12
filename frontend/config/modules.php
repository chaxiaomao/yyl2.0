<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22
 * Time: 15:47
 */

return [
    'player' => [
        'class' => 'frontend\modules\Player\Module',
    ],
    'apply' => [
        'class' => 'frontend\modules\Apply\Module',
    ],
    'attachments' => [
        'class' => 'cza\base\modules\Attachments\Module',
    ],
    'wechat' => [
        'class' => 'frontend\modules\Wechat\Module',
    ],
    'log-reader' => [
        'class' => 'zhuravljov\yii\logreader\Module',
        'aliases' => [
            'backend Errors' => '@backend/runtime/logs/backend_debug.log',
            'backend Info' => '@backend/runtime/logs/backend_info.log',
            'Console Errors' => '@backend/runtime/logs/app.log',

        ],
    ],
];