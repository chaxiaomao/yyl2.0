<?php

namespace frontend\modules\Center\controllers;

use common\models\c2\entity\ActivityModel;
use common\models\c2\entity\ActivityPlayerModel;
use common\models\c2\search\ActivityPlayerSearch;
use common\models\c2\search\ActivityPlayerVoteRecordSearch;
use frontend\components\behaviors\WechatAuthBehavior;
use frontend\controllers\ActivityController;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `Center` module
 */
class DefaultController extends ActivityController
{

    public function behaviors()
    {
        return [
            'wechatFilter' => [
                'class' => WechatAuthBehavior::className()
            ]
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($vasc)
    {
        $activityModel = ActivityModel::findOne(['seo_code' => $vasc]);
        $this->activity = $activityModel;
        $userId = \Yii::$app->user->id;
        $searchModel = new ActivityPlayerSearch();
        $searchModel->user_id = $userId;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
