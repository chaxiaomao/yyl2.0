<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 17:42
 */

namespace common\models\c2\statics;
use Yii;

/**
 *
 * Class FeUserType
 * @package common\models\c2\statics
 */
class LotteryRecordState extends AbstractStaticClass
{
    const STATE_DRAW = 2;  // load in when demand
    const TYPE_NOT_DRAW = 1;  // load in when demand

    protected static $_data;

    /**
     *
     * @param type $id
     * @param type $attr
     * @return string|array
     */
    public static function getData($id = '', $attr = '') {
        if (is_null(static::$_data)) {
            static::$_data = [
                static::STATE_DRAW => ['id' => static::STATE_DRAW, 'label' => Yii::t('app.c2', 'Draw')],
                static::TYPE_NOT_DRAW => ['id' => static::TYPE_NOT_DRAW, 'label' => Yii::t('app.c2', 'Not Draw')],
            ];
        }
        if ($id !== '' && !empty($attr)) {
            return static::$_data[$id][$attr];
        }
        if ($id !== '' && empty($attr)) {
            return static::$_data[$id];
        }
        return static::$_data;
    }

}