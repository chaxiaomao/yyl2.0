<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%activity}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $title
 * @property string $label
 * @property string $content
 * @property string $seo_code
 * @property string $start_at
 * @property string $end_at
 * @property integer $vote_freq
 * @property integer $area_limit
 * @property integer $share_number
 * @property string $income_number
 * @property integer $is_open_draw
 * @property integer $is_check
 * @property integer $start_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $is_released
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class ActivityModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
            [['area_limit', 'share_number', 'start_id', 'created_by', 'updated_by'], 'integer'],
            [['income_number'], 'number'],
            [['type', 'vote_freq', 'is_open_draw', 'is_check', 'is_released', 'status'], 'integer', 'max' => 4],
            [['title', 'label', 'seo_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'type' => Yii::t('app.c2', 'Type'),
            'title' => Yii::t('app.c2', 'Title'),
            'label' => Yii::t('app.c2', 'Label'),
            'content' => Yii::t('app.c2', 'Content'),
            'seo_code' => Yii::t('app.c2', 'Seo Code'),
            'start_at' => Yii::t('app.c2', 'Start At'),
            'end_at' => Yii::t('app.c2', 'End At'),
            'vote_freq' => Yii::t('app.c2', 'Vote Freq'),
            'area_limit' => Yii::t('app.c2', 'Area Limit'),
            'share_number' => Yii::t('app.c2', 'Share Number'),
            'income_number' => Yii::t('app.c2', 'Income Number'),
            'is_open_draw' => Yii::t('app.c2', 'Is Open Draw'),
            'is_check' => Yii::t('app.c2', 'Is Check'),
            'start_id' => Yii::t('app.c2', 'Start ID'),
            'created_by' => Yii::t('app.c2', 'Created By'),
            'updated_by' => Yii::t('app.c2', 'Updated By'),
            'is_released' => Yii::t('app.c2', 'Is Released'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\ActivityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\ActivityQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}