<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property string $id
 * @property string $code
 * @property string $label
 * @property integer $status
 * @property integer $position
 * @property string $created_at
 * @property string $updated_at
 */
class Region extends \cza\base\models\ActiveRecord {

    public $name;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['type'], 'integer'],
            [['status', 'position'], 'integer'],
            [['created_at', 'updated_at', 'type'], 'safe'],
            [['code', 'label'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'code' => Yii::t('app.c2', 'Code'),
            'label' => Yii::t('app.c2', 'Label'),
            'status' => Yii::t('app.c2', 'Status'),
            'position' => Yii::t('app.c2', 'Position'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\RegionQuery the active query used by this AR class.
     */
    public static function find() {
        return new \common\models\c2\query\RegionQuery(get_called_class());
    }

    /**
     * setup default values
     * */
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

//    public static function getCityHashMap($keyField, $valField, $province_id) {
//        $cityIds = [];
//        $rsModels = RegionRs::find()->where(['parent_id' => $province_id])->all();
//        if(!empty($rsModels)) {
//            foreach ($rsModels as $rsModel) {
//                $cityIds[] = $rsModel->child_id;
//            }
//        } 
//        
//        $cityHashMap = self::getHashMap('id', 'label', ['in', 'id', $cityIds]);
//        return $cityHashMap;
//    }

}
