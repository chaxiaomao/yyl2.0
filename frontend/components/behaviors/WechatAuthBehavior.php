<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/10 0010
 * Time: 下午 16:15
 */
namespace frontend\components\behaviors;

use Yii;
use yii\base\ActionFilter;

class WechatAuthBehavior extends ActionFilter
{

    public function beforeAction($action)
    {
        // 微信网页授权:
        if(!Yii::$app->wechat->isAuthorized()) {
            Yii::info('在微信客户端');
            // return Yii::$app->wechat->authorizeRequired()->send();
            return Yii::$app->wechat->authorizeRequired()->send();
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function afterAction($action, $result)
    {
        return parent::afterAction($action, $result); // TODO: Change the autogenerated stub
    }
}