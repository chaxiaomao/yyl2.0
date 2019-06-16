<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%lottery_prize_rs}}".
 *
 * @property string $id
 * @property string $prize_id
 * @property string $lottery_id
 * @property string $chance
 * @property integer $position
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class LotteryPrizeRsModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lottery_prize_rs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prize_id', 'lottery_id', 'position'], 'integer'],
            [['chance'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'prize_id' => Yii::t('app.c2', 'Prize ID'),
            'lottery_id' => Yii::t('app.c2', 'Lottery ID'),
            'chance' => Yii::t('app.c2', 'Chance'),
            'position' => Yii::t('app.c2', 'Position'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\LotteryPrizeRsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\LotteryPrizeRsQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

    public function getLottery()
    {
        return $this->hasOne(LotteryModel::className(), ['id' => 'lottery_id']);
    }

    public function getPrize()
    {
        return $this->hasOne(LotteryPrizeModel::className(), ['id' => 'prize_id']);
    }

}
