<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/17
 * Time: 22:26
 */

namespace frontend\widgets;


use yii\base\Widget;

class DailyStart extends Widget
{
    public $activityModel;

    public function run()
    {
        $model = $this->activityModel->dailyStart;
        return $this->render('dailyStart', [
            'model' => $model
        ]);
    }
}