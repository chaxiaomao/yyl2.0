<?php

namespace common\models\c2\entity;

use Yii;

/**
 * This is the model class for table "{{%gift_order}}".
 *
 * @property string $id
 * @property string $code
 * @property string $customer_id
 * @property integer $pay_method
 * @property string $activity_id
 * @property string $activity_player_id
 * @property string $discount_rate
 * @property string $discount_money
 * @property string $gift_name
 * @property string $obtain_score
 * @property integer $obtain_vote_number
 * @property string $remote_ip
 * @property string $memo
 * @property string $pay_price
 * @property integer $src_type
 * @property integer $state
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class GiftOrderModel extends \cza\base\models\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gift_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'activity_id', 'activity_player_id', 'obtain_vote_number'], 'integer'],
            [['discount_rate', 'discount_money', 'obtain_score', 'pay_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['code', 'gift_name', 'remote_ip', 'memo'], 'string', 'max' => 255],
            [['pay_method', 'src_type', 'state', 'status'], 'integer', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app.c2', 'ID'),
            'code' => Yii::t('app.c2', 'Code'),
            'customer_id' => Yii::t('app.c2', 'Customer ID'),
            'pay_method' => Yii::t('app.c2', 'Pay Method'),
            'activity_id' => Yii::t('app.c2', 'Activity ID'),
            'activity_player_id' => Yii::t('app.c2', 'Activity Player ID'),
            'discount_rate' => Yii::t('app.c2', 'Discount Rate'),
            'discount_money' => Yii::t('app.c2', 'Discount Money'),
            'gift_name' => Yii::t('app.c2', 'Gift Name'),
            'obtain_score' => Yii::t('app.c2', 'Obtain Score'),
            'obtain_vote_number' => Yii::t('app.c2', 'Obtain Vote Number'),
            'remote_ip' => Yii::t('app.c2', 'Remote Ip'),
            'memo' => Yii::t('app.c2', 'Memo'),
            'pay_price' => Yii::t('app.c2', 'Pay Price'),
            'src_type' => Yii::t('app.c2', 'Src Type'),
            'state' => Yii::t('app.c2', 'State'),
            'status' => Yii::t('app.c2', 'Status'),
            'created_at' => Yii::t('app.c2', 'Created At'),
            'updated_at' => Yii::t('app.c2', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\c2\query\GiftOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\c2\query\GiftOrderQuery(get_called_class());
    }

    /**
     * setup default values
     **/
    public function loadDefaultValues($skipIfSet = true) {
        parent::loadDefaultValues($skipIfSet);
        if ($this->isNewRecord) {
            $this->code = $this->generateOrderCode();
        }
    }

    public function getGift()
    {
        return $this->hasOne(GiftModel::className(), ['id' => 'gift_id']);
    }

    public function getActivityPlayer()
    {
        return $this->hasOne(ActivityPlayerModel::className(), ['id' => 'activity_player_id']);
    }

    public function getActivity()
    {
        return $this->hasOne(ActivityModel::className(), ['id' => 'activity_id']);
    }

    public function generateOrderCode()
    {
        //生成24位唯一订单号码，格式：YYYY-MMDD-HHII-SS-NNNN,NNNN-CC，其中：YYYY=年份，MM=月份，DD=日期，HH=24格式小时，II=分，SS=秒，NNNNNNNN=随机数，CC=检查码
        @date_default_timezone_set("PRC");
        //订购日期
        // $order_date = date('Y-m-d');
        //订单号码主体（YYYYMMDDHHIISSNNNNNNNN）
        $order_id_main = date('YmdHis') . rand(10000000, 99999999);
        //订单号码主体长度
        $order_id_len = strlen($order_id_main);
        $order_id_sum = 0;
        for ($i = 0; $i < $order_id_len; $i++) {
            $order_id_sum += (int)(substr($order_id_main, $i, 1));
        }
        //唯一订单号码（YYYYMMDDHHIISSNNNNNNNNCC）
        $order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100, 2, '0', STR_PAD_LEFT);
        return $order_id;
    }

}
