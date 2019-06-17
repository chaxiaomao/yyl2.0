<?php

namespace backend\modules\Lottery\controllers;

use Yii;
use common\models\c2\entity\LotteryModel;
use common\models\c2\search\LotterySearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for LotteryModel model.
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\LotteryModel';

    public function actions() {
        return \yii\helpers\ArrayHelper::merge(parent::actions(), [
            'ueditor' => [
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    //上传图片配置
                    'entity_class' => \common\models\c2\entity\ActivityModel::className(),
                    'entity_attribute' => 'content',
                    'imageUrlPrefix' => BACKEND_BASE_URL, /* 图片访问路径前缀 */
                    // 'imagePathFormat' => "/uploads/ueditor/{pathHash:default}/{id}/{CachingPath}/{hash}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                    'imagePathFormat' => "/uploads/ueditor/{pathHash:default}/{id}/{CachingPath}/{hash}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ],
        ]);
    }
    
    /**
     * Lists all LotteryModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LotteryModel model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * create/update a LotteryModel model.
     * fit to pajax call
     * @return mixed
     */
    public function actionEdit($id = null) 
    {
        $model = $this->retrieveModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            // if ($model->isNewRecord) {
            //     if ($model->save()) {
            //         Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            //         return $this->redirect('/lottery/default/edit?id=' . $model->id);
            //     } else {
            //         Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            //     }
            // }
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }

        $model->loadItems();
        
        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit', [ 'model' => $model,]) : $this->render('edit', [ 'model' => $model,]);
    }
    
    /**
     * Finds the LotteryModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return LotteryModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LotteryModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
