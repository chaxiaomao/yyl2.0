<?php

namespace frontend\modules\Player\controllers;

use common\models\c2\entity\ActivityPlayerModel;
use yii\web\Controller;

/**
 * Default controller for the `player` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($p = null)
    {
        $playerModel = ActivityPlayerModel::findOne(['player_code' => $p]);
        return $this->render('index', [
            'playerModel' => $playerModel
        ]);
    }
}
