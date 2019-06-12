<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12 0012
 * Time: 上午 9:36
 */

namespace frontend\controllers;


use common\models\c2\entity\FeUserModel;
use Yii;
use yii\web\Controller;

class ActivityController extends Controller
{

    public $activity;
    protected $_currentUser = null;
    protected $_wechatUser = null;

    public function getWechatUser() {
        if (is_null($this->_wechatUser)) {
            $this->_wechatUser = Yii::$app->wechat->getUser();
        }
        return $this->_wechatUser;
    }

    /**
     * could be boss/merchant/salesman/customer
     * @return FeUserModel
     */
    public function getCurrentUser(){
        if (is_null($this->_currentUser)) {
            $this->_currentUser = Yii::$app->user->getCurrentUser();
        }
        return $this->_currentUser;
    }

}