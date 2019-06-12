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
class ActivityPlayerType extends AbstractStaticClass
{
    const TYPE_SYS_ENTRY = 1;  // load in when demand
    const TYPE_USER_ENTRY = 2;  // load in when demand

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
                static::TYPE_SYS_ENTRY => ['id' => static::TYPE_SYS_ENTRY, 'label' => Yii::t('app.c2', 'Sys Entry')],
                static::TYPE_USER_ENTRY => ['id' => static::TYPE_USER_ENTRY, 'label' => Yii::t('app.c2', 'User Entry')],
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