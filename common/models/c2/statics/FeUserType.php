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
    const TYPE_CUSTOMER = 1;  // load in when demand
    const TYPE_EMPLOYEE = 2;  // load in when config settings init

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
                static::TYPE_CUSTOMER => ['id' => static::TYPE_CUSTOMER, 'label' => Yii::t('app.c2', 'Customer')],
                static::TYPE_EMPLOYEE => ['id' => static::TYPE_EMPLOYEE, 'label' => Yii::t('app.c2', 'Employee')],
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