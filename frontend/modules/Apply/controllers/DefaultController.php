<?php

namespace frontend\modules\Apply\controllers;

use common\models\c2\entity\ActivityModel;
use common\models\c2\entity\ActivityPlayerModel;
use common\models\c2\statics\Whether;
use frontend\components\behaviors\WechatAuthBehavior;
use frontend\controllers\ActivityController;
use frontend\models\ActivityApplyForm;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `apply` module
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
    public function actionIndex($s = null)
    {
        $activityModel = ActivityModel::findOne(['seo_code' => $s, 'is_released' => Whether::TYPE_YES]);
        if (is_null($activityModel)) {
            throw new NotFoundHttpException(Yii::t('app.c2', 'Activity disable.'));
        }
        $this->activity = $activityModel;
        $model = new ActivityPlayerModel();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post())) {
            Yii::info(Yii::$app->request->post());
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Apply successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }
        return $this->render('index', [
            'model' => $model,
            'activityModel' => $activityModel,
        ]);
    }
}
