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
    'lottery' => [
        'class' => 'frontend\modules\Lottery\Module',
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
            'backend Errors' => '@frontend/runtime/logs/backend_debug.log',
            'backend Info' => '@frontend/runtime/logs/backend_info.log',
            'Console Errors' => '@frontend/runtime/logs/app.log',
        ],
    ],
];