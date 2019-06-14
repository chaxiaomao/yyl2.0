<?php

namespace frontend\modules\Player\controllers;

use common\models\c2\entity\ActivityPlayerModel;
use common\models\c2\entity\ActivityPlayerVoteRecordModel;
use common\models\c2\search\ActivityPlayerVoteRecordSearch;
use common\models\c2\statics\ActivityPlayerState;
use common\models\c2\statics\Whether;
use frontend\components\behaviors\WechatAuthBehavior;
use frontend\controllers\ActivityController;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `player` module
 */
class DefaultController extends ActivityController
{

    // public $layout = '/main-empty';
    // return $this->render('index', [
    //     'playerModel' => $playerModel,
    //     'model' => $model,
    // ]);

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
        if (is_null($playerModel) || $playerModel->state == ActivityPlayerState::STATE_NOT_CHECK) {
            throw new NotFoundHttpException(Yii::t('app.c2', 'Player disable.'));
        }

        $activityModel = $playerModel->activity;
        $this->activity = $activityModel;

        $model = new ActivityPlayerVoteRecordModel();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post())) {
            $result = $model->checkLimit($activityModel);
            if ($result != true) {
                Yii::$app->session->setFlash($model->getMessageName(), [$result]);
            }
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Vote Success')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        $playerModel->updateCounters(['view_number' => 1]);
        return (Yii::$app->request->isAjax) ? $this->renderAjax('index', [
            'playerModel' => $playerModel, 'model' => $model,]) : $this->render('index', ['playerModel' => $playerModel, 'model' => $model,]);
    }
}
