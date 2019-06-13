<?php

namespace common\models\c2\entity;

use common\helpers\CodeGenerator;
use common\models\c2\statics\ActivityPlayerState;
use common\models\c2\statics\ActivityPlayerType;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%activity_player}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $user_id
 * @property integer $activity_id
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
    use \common\traits\AttachmentTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity_player}}';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'attachmentsBehavior' => [
                'class' => \cza\base\modules\Attachments\behaviors\AttachmentBehavior::className(),
                'attributesDefinition' => [
                    'avatar' => [
                        'class' => \common\models\c2\entity\EntityAttachmentImage::className(),
                        'validator' => 'image',
                        'rules' => [
                            'maxFiles' => 1,
                            'uploadRequired' => Yii::t('app.c2', 'Photo must upload.'),
                            // 'skipOnEmpty' => false,
                            // 'skipOnError' => false,
                            'extensions' => Yii::$app->params['config']['upload']['imageWhiteExts'],
                            // 'extensions' => ['jpg'],
                            'maxSize' => Yii::$app->params['config']['upload']['maxFileSize'],
                            // 'maxSize' => '2048',
                        ]
                    ]
                ]
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'activity_id', 'free_vote_number', 'gift_vote_number', 'total_vote_number', 'share_number', 'view_number'], 'integer'],
            [['income'], 'number'],
            [['content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['player_code', 'title', 'label', 'mobile_number'], 'string', 'max' => 255],
            [['state', 'status'], 'integer', 'max' => 4],
            [['content', 'title', 'activity_id'], 'required'],
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
            'activity_id' => Yii::t('app.c2', 'Activity'),
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
    public function loadDefaultValues($skipIfSet = true)
    {
        parent::loadDefaultValues($skipIfSet);
        if ($this->isNewRecord) {
            $this->player_code = CodeGenerator::getNumberCodeByDate($this);
        }
    }

    public function getUser()
    {
        return $this->hasOne(FeUserModel::className(), ['id' => 'user_id']);
    }

    public function getActivity()
    {
        return $this->hasOne(ActivityModel::className(), ['id' => 'activity_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        if ($insert) {
            if ($this->type == ActivityPlayerType::TYPE_USER_ENTRY) {
                $activityModel = $this->activity;
                if ($activityModel->is_check == 1) {
                    $this->updateAttributes(['state' => ActivityPlayerState::STATE_NOT_CHECK]);
                } elseif ($activityModel->is_check == 0) {
                    $this->updateAttributes(['state' => ActivityPlayerState::STATE_CHECKED]);
                }
            }

            // Set redis
            $redis = Yii::$app->redis;
            $kActivity = K_ACTIVITY_RANK . $this->activity_id;
            $kPlayer = K_PLAYER . $this->id;
            $redis->executeCommand('ZADD', [$kActivity, 0, $kPlayer]);
        }
    }

    public function getPhotos()
    {
        $albums = $this->attachmentImages;
        $albumsUrl = [];
        foreach ($albums as $album) {
            $albumsUrl[] = $album->getOriginalUrl();
        }
        return $albumsUrl;
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

    public function getActivityRank()
    {
        $redis = Yii::$app->redis;
        $kActivity = K_ACTIVITY_RANK . $this->activity_id;
        $kPlayer = K_PLAYER . $this->id;
        $items = $redis->executeCommand('ZREVRANGE', [$kActivity, 0, -1, 'WITHSCORES']);
        $result = [
            'currentRank' => 0,
            'beforeVoteNumber' => 0,
            'afterVoteNumber' => 0,
        ];
        $result['currentRank'] = 1 + $redis->executeCommand('ZREVRANK', [$kActivity, $kPlayer]);
        foreach ($items as $k => $v) {
            $id = explode(':', $v)[1];
            if ($this->id == $id) {
                if (!empty($items[$k - 1])) {
                    $result['beforeVoteNumber'] = $items[$k - 1] - $this->total_vote_number;
                } else {
                    $result['beforeVoteNumber'] = 0;
                }
                if (!empty($items[$k + 3])) {
                    $result['afterVoteNumber'] = $this->total_vote_number - $items[$k + 3];
                } else {
                    $result['afterVoteNumber'] = 0;
                }
            }
        }
        // Yii::info('前1名相差：' . $result['beforeVoteNumber']);
        // Yii::info('后1名相差：' . $result['afterVoteNumber']);
        // Yii::info('当前' . $this->player_code . '排名：' . $result['currentRank']);
        return $result;
    }

}
