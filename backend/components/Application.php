<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\components;

use Yii;
use yii\helpers\Url;
use yii\base\InvalidRouteException;

/**
 * Description of Application
 * @property \cza\base\helpers\Helper $czaHelper The request component. This property is read-only.
 * @author ben
 */
class Application extends \yii\web\Application {

    public function behaviors() {
        return [
//            'basicAuth' => [
//                'class' => \yii\filters\auth\HttpBasicAuth::className(),
//            ],

            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'formats' => [
                    'text/html' => \yii\web\Response::FORMAT_HTML,
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                    'application/xml' => \yii\web\Response::FORMAT_XML,
                ],
                'languages' => [
//                    'en-US',
                    'zh-CN',
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
//                'except' => ['debug/default/toolbar', 'debug/default/view'],
                'except' => ['debug*',],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
//                        'actions' => ['logout', 'index', 'page'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'logout' => ['get', 'post'],
                ],
            ],
//            'action-time' => [
//                'class' => \cza\base\behaviors\ActionTimeFilter::className(),
//            ],
        ];
    }

    /**
     * correct wrong bower path
     * @param string $path the directory that stores vendor files.
     */
    public function setVendorPath($path) {
        parent::setVendorPath($path);
        Yii::setAlias('@bower', $this->getVendorPath() . DIRECTORY_SEPARATOR . 'bower-asset');
    }

}
