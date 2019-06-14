<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/14 0014
 * Time: 下午 12:59
 */
namespace frontend\themes\stone;

class Stone extends \yii\web\AssetBundle
{
    public $css = [
        'css/main.css',
        'css/swiper.min.css',
        'css/galpop.css',
        'css/sortable.css',
    ];

    public $js = [
        'js/jquery.galpop.min.js',
        'js/jquery.rotate.min.js',
        'js/swiper.min.js',
        'js/leftTime.min.js',
        'js/sortable.js',
        'js/scroll.js',
        'js/loading.js',
        'https://res.wx.qq.com/open/js/jweixin-1.0.0.js',  // wechat js SDK
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
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