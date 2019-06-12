<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%activity_player_vote_record}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $user_id
 * @property string $activity_player_id
 * @property integer $vote_number
 * @property string $gift_id
 * @property string $order_id
 * @property string $remote_ip
 * @property integer $state
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class ActivityPlayerVoteRecordModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity_player_vote_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'activity_player_id', 'vote_number', 'gift_id', 'order_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'state', 'status'], 'integer', 'max' => 4],
            [['remote_ip'], 'string', 'max' => 255],
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
            'user_id' => Yii::t('app.c2', 'User ID'),
            'activity_player_id' => Yii::t('app.c2', 'Activity Player ID'),
            'vote_number' => Yii::t('app.c2', 'Vote Number'),
            'gift_id' => Yii::t('app.c2', 'Gift ID'),
            'order_id' => Yii::t('app.c2', 'Order ID'),
            'remote_ip' => Yii::t('app.c2', 'Remote Ip'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\ActivityPlayerVoteRecordQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\ActivityPlayerVoteRecordQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
