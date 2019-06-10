<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/10 0010
 * Time: 下午 18:20
 */

namespace frontend\components\actions;


use yii\base\Action;

class ActivityShareAction extends Action
{

    public function run()
    {
        $params = \Yii::$app->request->post();
        \Yii::info($params);
    }
}