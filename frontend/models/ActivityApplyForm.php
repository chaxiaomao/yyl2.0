<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/12 0012
 * Time: 下午 17:05
 */

namespace frontend\models;


use common\models\c2\entity\ActivityPlayerModel;
use yii\helpers\ArrayHelper;

class ActivityApplyForm extends ActivityPlayerModel
{
    public $activityCode;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['content', 'title', 'activity_id'], 'required'],
        ]);
    }

}