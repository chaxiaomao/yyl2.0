<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%activity_player}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $user_id
 * @property string $income
 * @property string $player_code
 * @property string $title
 * @property string $label
 * @property string $content
 * @property string $mobile_number
 * @property integer $free_vote_number
 * @property integer $gift_vote_number
 * @property integer $total_vote_number
 * @property integer $share_number
 * @property integer $view_number
 * @property integer $state
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class ActivityPlayerModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity_player}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'free_vote_number', 'gift_vote_number', 'total_vote_number', 'share_number', 'view_number'], 'integer'],
            [['income'], 'number'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['player_code', 'title', 'label', 'mobile_number'], 'string', 'max' => 255],
            [['state', 'status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'type' => Yii::t('app.c2', 'Entry Type'),
            'user_id' => Yii::t('app.c2', 'User Name'),
            'income' => Yii::t('app.c2', 'Income'),
            'player_code' => Yii::t('app.c2', 'Player Code'),
            'title' => Yii::t('app.c2', 'Title'),
            'label' => Yii::t('app.c2', 'Label'),
            'content' => Yii::t('app.c2', 'Content'),
            'mobile_number' => Yii::t('app.c2', 'Mobile Number'),
            'free_vote_number' => Yii::t('app.c2', 'Free Vote Number'),
            'gift_vote_number' => Yii::t('app.c2', 'Gift Vote Number'),
            'total_vote_number' => Yii::t('app.c2', 'Total Vote Number'),
            'share_number' => Yii::t('app.c2', 'Share Number'),
            'view_number' => Yii::t('app.c2', 'View Number'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\ActivityPlayerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\ActivityPlayerQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
