<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%lottery_record}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $code
 * @property string $user_id
 * @property string $lottery_name
 * @property string $prize_name
 * @property string $lottery_id
 * @property string $prize_id
 * @property integer $state
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class LotteryRecordModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lottery_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'lottery_id', 'prize_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'state', 'status'], 'integer', 'max' => 4],
            [['code', 'prize_name', 'lottery_name'], 'string', 'max' => 255],
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
            'code' => Yii::t('app.c2', 'Code'),
            'user_id' => Yii::t('app.c2', 'User ID'),
            'lottery_id' => Yii::t('app.c2', 'Lottery ID'),
            'prize_id' => Yii::t('app.c2', 'Prize ID'),
            'prize_name' => Yii::t('app.c2', 'Prize Name'),
            'lottery_name' => Yii::t('app.c2', 'Lottery Name'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\LotteryRecordQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\LotteryRecordQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

    public function getPrize()
    {
        return $this->hasOne(LotteryPrizeModel::className(), ['id' => 'prize_id']);
    }

}
