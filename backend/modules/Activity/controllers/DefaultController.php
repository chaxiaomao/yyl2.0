<?php

namespace backend\modules\Activity\controllers;

use Yii;
use common\models\c2\entity\ActivityModel;
use common\models\c2\search\ActivitySearch;

use cza\base\components\controllers\backend\ModelController as Controller;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * DefaultController implements the CRUD actions for ActivityModel model.
 */
class DefaultController extends Controller
{
    public $modelClass = 'common\models\c2\entity\ActivityModel';

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
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
                'entityClass' => \common\models\c2\entity\ActivityModel::className(),
                'entityAttribute' => 'album',
                // 'onComplete' => function ($filename, $params) {
                //     Yii::info($filename);
                //     Yii::info($params);
                // }
            ],
        ]);
    }
    
    /**
     * Lists all ActivityModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->retrieveModel(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActivityModel model.
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
     * create/update a ActivityModel model.
     * fit to pajax call
     * @return mixed
     */
    public function actionEdit($id = null) 
    {
        $model = $this->retrieveModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash($model->getMessageName(), [Yii::t('app.c2', 'Saved successful.')]);
            } else {
                Yii::$app->session->setFlash($model->getMessageName(), $model->errors);
            }
        }
        
        return (Yii::$app->request->isAjax) ? $this->renderAjax('edit', [ 'model' => $model,]) : $this->render('edit', [ 'model' => $model,]);
    }
    
    /**
     * Finds the ActivityModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActivityModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivityModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionQrCode($id = null)
    {
        try {
            $qr = Yii::$app->get('qr');
        } catch (InvalidConfigException $e) {
            new NotFoundHttpException($e->getMessage());
        }
        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', $qr->getContentType());

        $model = $this->retrieveModel($id);

        return $qr
            // ->useLogo(Yii::getAlias('@frontend') . '/images/logo.jpg')
            // ->setLogoWidth(10)
            ->setText(FRONTEND_BASE_URL . '/s/' . $model->seo_code)
            ->writeString();
    }

}
