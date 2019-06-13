<?php

namespace common\models\c2\statics;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * ConfigType
 *
 * @author ben
 */
class OrderPayState extends AbstractStaticClass {

    const UN_PAY = 1;
    const PAY = 2;
    
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
                static::PAY => ['id' => static::PAY, 'label' => Yii::t('app.c2', 'Had Pay')],
                static::UN_PAY => ['id' => static::UN_PAY, 'label' => Yii::t('app.c2', 'Un Pay')],
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
