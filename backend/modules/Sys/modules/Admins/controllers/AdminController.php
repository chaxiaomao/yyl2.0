<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace backend\modules\Sys\modules\Admins\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use backend\models\c2\entity\rbac\BeUserSearch;
use dektrium\user\controllers\AdminController as BaseController;

/**
 * AdminController allows you to administrate users.
 *
 * @property Module $module
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com
 */

class AdminController extends BaseController {

    /**
     * @inheritdoc
     */
//    public function behaviors() {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['post'],
//                    'confirm' => ['post'],
//                    'resend-password' => ['post'],
//                    'block' => ['post'],
//                    'switch' => ['post'],
//                ],
//            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'ruleConfig' => [
//                    'class' => AccessRule::className(),
//                ],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['switch'],
//                        'roles' => ['@'],
//                    ],
//                    [
//                        'allow' => true,
//                        'roles' => ['admin'],
//                    ],
//                ],
//            ]
//        ];
//    }

    /**
     * Lists all User models.
     *
     * @return mixed
     */
    public function actionIndex() {

        Url::remember('', 'actions-redirect');
        $searchModel = \Yii::createObject(BeUserSearch::className());
        $dataProvider = $searchModel->search(\Yii::$app->request->get());
        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Updates an existing profile.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdateProfile($id) {
        Url::remember('', 'actions-redirect');
        $user = $this->findModel($id);
        $profile = $user->profile;

        if ($profile == null) {
            $profile = \Yii::createObject(Profile::className());
            $profile->link('user', $user);
        }

        // Load Old Image
        $oldImage = $profile->avatar;

        // Load avatarPath from Module Params
        $avatarPath = \Yii::getAlias($this->module->avatarPath);

        // Create uploadAvatar Instance
        $image = $profile->uploadAvatar($avatarPath);

        // Profile Event
        $event = $this->getProfileEvent($profile);

        // Ajax Validation
        $this->performAjaxValidation($profile);

        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);

        if ($profile->load(\Yii::$app->request->post()) && $profile->save()) {

            // revert back if no valid file instance uploaded
            if ($image === false) {

                $profile->avatar = $oldImage;
            } else {

                // if is there an old image, delete it
                if ($oldImage) {
                    $profile->deleteImage($oldImage);
                }

                // upload new avatar
                $profile->avatar = $image->name;
            }

            \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Profile details have been updated'));

            $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);

            return $this->refresh();
        }
//        else{
//            Yii::info($profile->errors);
//        }

        return $this->render('_profile', [
                    'user' => $user,
                    'profile' => $profile,
        ]);
    }

    /**
     * Deletes selected User models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed
     */
    public function actionDeleteMultiple() {
        $ids = \Yii::$app->request->post('ids');

        if (!$ids) {
            return;
        }

        foreach ($ids as $id) {
            $this->findModel($id)->delete();
        }

        // Set Success Message
        \Yii::$app->session->setFlash('success', \Yii::t('userextended', 'Delete Success!'));

        $searchModel = \Yii::createObject(BeUserSearch::className());
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Blocks the user.
     *
     * @param int $id
     * @return Response
     */
    public function actionBlock($id) {
        if ($id == \Yii::$app->user->getId()) {
            \Yii::$app->getSession()->setFlash('danger', \Yii::t('user', 'You can not block your own account'));
        } else {
            $user = $this->findModel($id);
            $event = $this->getUserEvent($user);
            if ($user->getIsBlocked()) {
                $this->trigger(self::EVENT_BEFORE_UNBLOCK, $event);
                $user->unblock();
                $this->trigger(self::EVENT_AFTER_UNBLOCK, $event);
                \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been unblocked'));
            } else {
                $this->trigger(self::EVENT_BEFORE_BLOCK, $event);
                $user->block();
                $this->trigger(self::EVENT_AFTER_BLOCK, $event);
                \Yii::$app->getSession()->setFlash('warning', \Yii::t('user', 'User has been blocked'));
            }
        }

        return $this->redirect(Url::previous('actions-redirect'));
    }

    /**
     * Active selected User models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed
     */
    public function actionActivemultiple() {
        $ids = \Yii::$app->request->post('ids');

        if (!$ids) {
            return;
        }

        foreach ($ids as $id) {
            $model = $this->findModel($id);

            if ($model->getIsBlocked()) {
                $model->unblock();
                \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'User has been unblocked'));
            }
        }
    }

    /**
     * Deactive selected User models.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed
     */
    public function actionDeactivemultiple() {
        $ids = \Yii::$app->request->post('ids');

        if (!$ids) {
            return;
        }

        foreach ($ids as $id) {
            $model = $this->findModel($id);

            if (!$model->getIsBlocked()) {
                $model->block();
                \Yii::$app->getSession()->setFlash('warning', \Yii::t('user', 'User has been blocked'));
            }
        }
    }

}
