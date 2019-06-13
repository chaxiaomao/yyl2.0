<?php

namespace frontend\modules\Player\controllers;

use common\models\c2\entity\ActivityPlayerModel;
use common\models\c2\statics\ActivityPlayerState;
use common\models\c2\statics\Whether;
use frontend\components\behaviors\WechatAuthBehavior;
use frontend\controllers\ActivityController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `player` module
 */
class DefaultController extends ActivityController
{

    // public $layout = '/main-empty';
    /**
     * {@inheritdoc}
     */
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
    public function actionIndex($p = null)
    {
        $playerModel = ActivityPlayerModel::findOne(['player_code' => $p]);
        $playerModel->getActivityRank();
        $activityModel = $playerModel->activity;
        $this->activity = $activityModel;
        if ($playerModel->state == ActivityPlayerState::STATE_NOT_CHECK
            || $activityModel->is_released == Whether::TYPE_NO) {
            throw new NotFoundHttpException(Yii::t('app.c2', 'Player disable.'));
        }
        $playerModel->updateCounters(['view_number' => 1]);
        return $this->render('index', [
            'playerModel' => $playerModel
        ]);
    }
}
