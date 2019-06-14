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
class FeUserType extends AbstractStaticClass
{
    const TYPE_SYS_REGISTRATION = 1;  // load in when demand
    const TYPE_WECHAT_REGISTRATION = 2;  // load in when demand

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
                static::TYPE_SYS_REGISTRATION => ['id' => static::TYPE_SYS_REGISTRATION, 'label' => Yii::t('app.c2', 'Sys Registration')],
                static::TYPE_WECHAT_REGISTRATION => ['id' => static::TYPE_WECHAT_REGISTRATION, 'label' => Yii::t('app.c2', 'User Registration')],
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