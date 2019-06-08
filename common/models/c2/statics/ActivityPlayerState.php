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
class ActivityPlayerState extends AbstractStaticClass
{
    const TYPE_CHECKED = 1;  // load in when demand
    const TYPE_NOT_CHECK = 2;  // load in when demand

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
                static::TYPE_CHECKED => ['id' => static::TYPE_CHECKED, 'label' => Yii::t('app.c2', 'Checked')],
                static::TYPE_NOT_CHECK => ['id' => static::TYPE_NOT_CHECK, 'label' => Yii::t('app.c2', 'Not Check')],
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