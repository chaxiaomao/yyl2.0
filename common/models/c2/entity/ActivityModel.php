<?php

namespace common\models\c2\entity;

use backend\models\c2\entity\rbac\BeUser;
use common\helpers\CodeGenerator;
use cza\base\models\statics\EntityModelStatus;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

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
 * @property integer $vote_number_limit
 * @property integer $area_limit
 * @property integer $vote_number
 * @property integer $share_number
 * @property integer $view_number
 * @property string $income
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
    use \common\traits\AttachmentTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            BlameableBehavior::className()
        ]); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['start_at', 'end_at', 'created_at', 'updated_at'], 'safe'],
            [['area_limit', 'share_number', 'view_number', 'vote_number', 'start_id', 'created_by', 'updated_by'], 'integer'],
            [['income'], 'number'],
            [['type', 'is_open_draw', 'is_check', 'is_released', 'status'], 'integer', 'max' => 4],
            [['title', 'label', 'seo_code'], 'string', 'max' => 255],
            [['vote_number_limit'], 'string', 'max' => 100],
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
            'vote_number_limit' => Yii::t('app.c2', 'Vote Number Limit'),
            'area_limit' => Yii::t('app.c2', 'Area Limit'),
            'vote_number' => Yii::t('app.c2', 'Vote Number'),
            'view_number' => Yii::t('app.c2', 'View Number'),
            'share_number' => Yii::t('app.c2', 'Share Number'),
            'income' => Yii::t('app.c2', 'Income'),
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
        if ($this->isNewRecord) {
            // $this->seo_code = Yii::$app->security->generateRandomString(6);
            $this->seo_code = CodeGenerator::getActivityCodeByDate($this, 'A');
        }
    }

    public function getCreator()
    {
        return $this->hasOne(BeUser::className(), ['id' => 'created_by']);
    }

    /**
     * return a format data array for select2 ajax response
     * @param type $keyField
     * @param type $valField
     * @param type $condition
     * @return array
     */
    public static function getOptionsListCallable($keyField, $valField, $condition = '', $params = [])
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return parent::getOptionsListCallable($keyField, $valField, $condition, $params); // TODO: Change the autogenerated stub
    }

    public function getPhotos() {
        $albums = $this->attachmentImages;
        $albumsUrl = [];
        foreach ($albums as $album) {
            $albumsUrl[] = $album->getOriginalUrl();
        }
        return $albumsUrl;
    }

    public static function getAllActivities()
    {
        $first = ['0' => Yii::t('app.c2', 'Apply To All Activities')];
        $items = self::getHashMap('id', 'title');
        return ArrayHelper::merge($first, $items);
    }

    public function getActivityGifts()
    {
        $gifts = GiftModel::find()->where(['activity_id' => 0, 'status' => EntityModelStatus::STATUS_ACTIVE])->all();
        return ArrayHelper::merge($gifts, $this->getGifts()->all());
    }

    public function getGifts()
    {
        return $this->hasMany(GiftModel::className(), ['activity_id' => 'id']);
    }

    public function getActivityPlayers()
    {
        return $this->hasMany(ActivityPlayerModel::className(), ['activity_id' => 'id']);
    }

    public function beforeDelete()
    {
        if ($this->getActivityPlayers()->count() > 0) {
            throw new BadRequestHttpException(Yii::t('app.c2', 'This activity has players.'));
        }
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

}
