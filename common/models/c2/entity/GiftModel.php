<?php

namespace common\models\c2\entity;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%gift}}".
 *
 * @property string $id
 * @property string $name
 * @property string $label
 * @property string $activity_id
 * @property string $code
 * @property string $obtain_score
 * @property integer $obtain_vote_number
 * @property string $price
 * @property integer $position
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class GiftModel extends \cza\base\models\ActiveRecord
{
    use \common\traits\AttachmentTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gift}}';
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
            [['activity_id', 'obtain_vote_number'], 'integer'],
            [['obtain_score', 'price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'label', 'code'], 'string', 'max' => 255],
            [['position', 'status'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'name' => Yii::t('app.c2', 'Name'),
            'label' => Yii::t('app.c2', 'Label'),
            'activity_id' => Yii::t('app.c2', 'Activity'),
            'code' => Yii::t('app.c2', 'Code'),
            'obtain_score' => Yii::t('app.c2', 'Obtain Score'),
            'obtain_vote_number' => Yii::t('app.c2', 'Obtain Vote Number'),
            'price' => Yii::t('app.c2', 'Price'),
            'position' => Yii::t('app.c2', 'Position'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\GiftQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\GiftQuery(get_called_class());
    }
    
    /**
    * setup default values
    **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
        if ($this->isNewRecord) {
            $this->code = Yii::$app->security->generateRandomString(4);
        }
    }

    public function getActivity()
    {
        return $this->hasOne(ActivityModel::className(), ['id' => 'activity_id']);
    }

}
