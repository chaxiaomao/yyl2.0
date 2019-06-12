<?php

namespace frontend\modules\Apply\controllers;

use common\models\c2\entity\ActivityModel;
use common\models\c2\statics\Whether;
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
        $model = new ActivityApplyForm();
        $model->activityCode = $activityModel->seo_code;
        $model->user_id = Yii::$app->user->identity->id;
        $model->activity_id = $activityModel->id;
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post())) {
            Yii::info(Yii::$app->request->post());
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
