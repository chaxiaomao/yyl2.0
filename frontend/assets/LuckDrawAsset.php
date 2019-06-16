<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LuckDrawAsset extends AssetBundle
{

    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $css = [
        // 'css/dmaku.css',
        'GB-canvas-turntable/css/typo/typo.css',
        'GB-canvas-turntable/css/GB-canvas-turntable.css'
    ];
    public $js = [
         'GB-canvas-turntable/js/zepto.min.js',
        // 'js/kinerLottery.js',
        'https://res.wx.qq.com/open/js/jweixin-1.0.0.js',  // wechat js SDK
        'GB-canvas-turntable/js/GB-canvas-turntable.js'
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
        // 'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    public function init()
    {
        $this->sourcePath = '@app/themes/' . CZA_FRONTEND_THEME . '/assets';
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,   // 这是设置所有js放置的位置
    ];

}
