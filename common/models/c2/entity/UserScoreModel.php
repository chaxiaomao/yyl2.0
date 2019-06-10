<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%user_score}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $score_number
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class UserScoreModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_score}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['score_number'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'user_id' => Yii::t('app.c2', 'User ID'),
            'score_number' => Yii::t('app.c2', 'Score Number'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\UserScoreQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\UserScoreQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
    }

}
