<?php

namespace frontend\themes\eggplant;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Eggplant extends AssetBundle
{
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $css = [
        'css/main.css',
        'css/swiper.min.css',
        'css/galpop.css',
    ];

    public $js = [
        'js/jquery.galpop.min.js',
        'js/jquery.rotate.min.js',
        'js/swiper.min.js',
        'js/leftTime.min.js',
        'https://res.wx.qq.com/open/js/jweixin-1.0.0.js',  // wechat js SDK
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $jsOptions=[
        'position'=>\yii\web\View::POS_HEAD,
    ];

    public function init()
    {
        $this->sourcePath = '@app/themes/' . CZA_FRONTEND_THEME. '/assets';
        parent::init();
    }

    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

}
