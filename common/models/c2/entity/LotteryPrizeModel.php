<?php

namespace common\models\c2\entity;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%lottery_prize}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $name
 * @property string $label
 * @property string $code
 * @property integer $store_number
 * @property integer $position
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class LotteryPrizeModel extends \cza\base\models\ActiveRecord
{
    use \common\traits\AttachmentTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lottery_prize}}';
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
            [['store_number', 'position'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['type', 'status'], 'integer', 'max' => 4],
            [['name', 'label', 'code'], 'string', 'max' => 255],
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
            'name' => Yii::t('app.c2', 'Name'),
            'label' => Yii::t('app.c2', 'Label'),
            'code' => Yii::t('app.c2', 'Code'),
            'store_number' => Yii::t('app.c2', 'Store Number'),
            'position' => Yii::t('app.c2', 'Position'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\LotteryPrizeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\LotteryPrizeQuery(get_called_class());
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

}
