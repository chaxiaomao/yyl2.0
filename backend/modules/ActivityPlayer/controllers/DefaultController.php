<?php

namespace backend\modules\ActivityPlayer\controllers;

use Yii;
use common\models\c2\entity\ActivityPlayerModel;
use common\models\c2\search\ActivityPlayerSearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for ActivityPlayerModel model.
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\ActivityPlayerModel';

    public function actions() {
        return \yii\helpers\ArrayHelper::merge(parent::actions(), [
            'search-user' => [
                'class' => '\cza\base\components\actions\common\OptionsListAction',
                'modelClass' => \common\models\c2\entity\FeUserModel::className(),
                'listMethod' => 'getOptionsListCallable',
                'keyAttribute' => 'id',
                'valueAttribute' => 'username',
                'queryAttribute' => 'username',
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'search-activity' => [
                'class' => '\cza\base\components\actions\common\OptionsListAction',
                'modelClass' => \common\models\c2\entity\ActivityModel::className(),
                'listMethod' => 'getOptionsListCallable',
                'keyAttribute' => 'id',
                'valueAttribute' => 'title',
                'queryAttribute' => 'title',
                'checkAccess' => [$this, 'checkAccess'],
            ],
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
            'images-sort' => [
                'class' => \cza\base\components\actions\common\AttachmentSortAction::className(),
                'attachementClass' => \common\models\c2\entity\EntityAttachmentImage::className(),
            ],
            'images-delete' => [
                'class' => \cza\base\components\actions\common\AttachmentDeleteAction::className(),
                'attachementClass' => \common\models\c2\entity\EntityAttachmentImage::className(),
            ],
            'images-upload' => [
                'class' => \cza\base\components\actions\common\AttachmentUploadAction::className(),
                'attachementClass' => \common\models\c2\entity\EntityAttachmentImage::className(),
                'entityClass' => \common\models\c2\entity\ActivityPlayerModel::className(),
                'entityAttribute' => 'album',
                // 'onComplete' => function ($filename, $params) {
                //     Yii::info($filename);
                //     Yii::info($params);
                // }
            ],
        ]);
    }
    
    /**
     * Lists all ActivityPlayerModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivityPlayerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActivityPlayerModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * create/update a ActivityPlayerModel model.
     * fit to pajax call
     * @return mixed
     */
    public function actionEdit($id = null) 
    {
        $model = $this->retrieveModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->isNewRecord) {
                if ($model->save()) {
                    Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
                    return $this->redirect('/activity-player/default/edit?id=' . $model->id);
                } else {
                    Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
                }
            }
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }
        
        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit', [ 'model' => $model,]) : $this->render('edit', [ 'model' => $model,]);
    }
    
    /**
     * Finds the ActivityPlayerModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActivityPlayerModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivityPlayerModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
