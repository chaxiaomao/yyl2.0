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
