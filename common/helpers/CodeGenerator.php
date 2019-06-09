<?php

namespace common\helpers;

use Yii;
use common\models\c2\entity\SalesActivity;
use yii\helpers\ArrayHelper;

/**
 * CodeGenerator
 * 
 * @author Ben Bi <jianbinbi@gmail.com>
 */
class CodeGenerator extends \yii\base\Component {

    public static $format = '%1$s%2$s%3$010d';

    public static function getCodeByDate(\yii\db\ActiveRecord $record, $prefix = '') {
        $maxId = $record->find()->max('id') + 1;
        return sprintf('%1$s%2$s%3$s%4$08d', $prefix, date("Ymd"), strtoupper(Yii::$app->security->generateRandomString(2)), $maxId);
    }

    public static function getActivityCodeByDate(\yii\db\ActiveRecord $record, $prefix = '') {
        $maxId = $record->find()->max('id') + 1;
        return sprintf('%1$s%2$s%3$s%4$08d', $prefix, date("His"), strtoupper(Yii::$app->security->generateRandomString(2)), $maxId);
    }

    public static function getNumberCodeByDate(\yii\db\ActiveRecord $record) {
        $maxId = $record->find()->max('id') + 1;
        return sprintf('%1$s%2$s', date("His"), $maxId);
    }

}
