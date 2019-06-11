<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/11 0011
 * Time: 上午 9:33
 */
namespace frontend\widgets;

use yii\base\Widget;

class CounterDown extends Widget
{
    public $activityModel;

    public function run()
    {
        return $this->render('CounterDown', ['activityModel' => $this->activityModel]);
    }
}