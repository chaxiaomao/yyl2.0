<?php

namespace frontend\modules\Wechat\controllers;

use common\helpers\DeviceLogHelper;
use common\models\c2\entity\ActivityPlayerModel;
use common\models\c2\entity\ActivityPlayerVoteRecordModel;
use common\models\c2\entity\FeUserModel;
use common\models\c2\entity\GiftModel;
use common\models\c2\entity\GiftOrderModel;
use common\models\c2\entity\OrderGiftRsModel;
use common\models\c2\entity\ActivityEntranceModel;
use common\models\c2\entity\UserPointModel;
use common\models\c2\entity\VoteRecordModel;
use common\models\c2\statics\ActivityPlayerState;
use common\models\c2\statics\OrderPaymentType;
use common\models\c2\statics\OrderPayState;
use common\models\c2\statics\OrderPayType;
use common\models\c2\statics\VoteType;
use common\models\c2\statics\Whether;
use cza\base\models\statics\EntityModelStatus;
use cza\base\models\statics\ResponseDatum;
use EasyWeChat\Payment\Order;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `wechat` module
 */
class DefaultController extends Controller
{

    public $enableCsrfValidation = false;

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

    }

    public function actionPayment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!Yii::$app->request->isPost) {
            return false;
        }
        $params = Yii::$app->request->post();
        $playerModel = ActivityPlayerModel::findOne($params['player_id']);
        if ($playerModel->state == ActivityPlayerState::STATE_NOT_CHECK) {
            return ResponseDatum::getErrorDatum(['message' => Yii::t('app.c2', 'Player disable.')], false);
        }
        $activityModel = $playerModel->activity;
        if ($activityModel->is_released != Whether::TYPE_YES || time() > strtotime($activityModel->end_at)) {
            return ResponseDatum::getErrorDatum(['message' => Yii::t('app.c2', 'Activity disable.')], false);
        }
        $giftModel = GiftModel::findOne($params['gift_id']);
        $orderModel = new GiftOrderModel();
        $orderModel->loadDefaultValues();
        $attributes = [
            'customer_id' => Yii::$app->user->id,
            'pay_method' => OrderPaymentType::TYPE_WECHAT_PAY,
            'activity_id' => $activityModel->id,
            'activity_player_id' => $playerModel->id,
            'discount_rate' => 0,
            'discount_money' => 0,
            'gift_name' => $giftModel->name,
            'obtain_score' => $giftModel->obtain_score,
            'obtain_vote_number' => $giftModel->obtain_vote_number,
            'remote_ip' => Yii::$app->request->userIP,
            'memo' => '',
            'pay_price' => $giftModel->price,
            'src_type' => DeviceLogHelper::getDeviceType(),
            'state' => OrderPayState::UN_PAY
        ];
        $orderModel->setAttributes($attributes);
        if ($orderModel->save()) {
            $payment = Yii::$app->wechat->payment;
            $conf = [
                'trade_type' => 'JSAPI', // JSAPI，NATIVE，APP...
                'body' => Yii::t('app.c2', 'Pay Body'),
                'detail' => Yii::t('app.c2', 'Gift to {s1} pay for {s2}', [
                    's1' => $activityModel->title,
                    's2' => $giftModel->name,
                ]),
                'out_trade_no' => $orderModel->code,
                'total_fee' => $orderModel->pay_price * 100, // 单位：分 * 100 = 元
                'notify_url' => FRONTEND_BASE_URL . '/wechat/default/payment-notify',// 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'openid' => Yii::$app->wechat->getUser()->openid, // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            ];
            $wxPayOrder = new Order($conf);
            $prepayRequest = $payment->prepare($wxPayOrder);
            if ($prepayRequest->return_code = 'SUCCESS' && $prepayRequest->result_code == 'SUCCESS') {
                $prepayId = $prepayRequest->prepay_id;
                $jsApiConfig = $payment->configForPayment($prepayId);
                return $jsApiConfig;
            } else {
                // throw new yii\base\ErrorException('微信支付异常, 请稍后再试');
                Yii::info($orderModel->errors);
                return ResponseDatum::getErrorDatum(['message' => Yii::t('app.c2', 'Wechat Pay Error')], false);
            }
        }
        return ResponseDatum::getErrorDatum(['message' => Yii::t('app.c2', 'Vote Fail')], false);
    }

    public function actionPaymentNotify()
    {
        $response = Yii::$app->wechat->payment->handleNotify(function ($notify, $success) {
            $order = GiftOrderModel::findOne(['code' => $notify->out_trade_no]);
            if ($order->state == OrderPayState::PAY) {
                return 'ok';
            }
            $attributes = [
                'type' => VoteType::TYPE_GIFT,
                'user_id' => $order->customer_id,
                'activity_player_id' => $order->activity_id,
                'vote_number' => $order->obtain_vote_number,
                'order_id' => $order->id,
                'gift_id' => 0,
                'remote_ip' => $order->remote_ip,
            ];
            $model = new ActivityPlayerVoteRecordModel();
            $model->setAttributes($attributes);
            if ($model->save()) {
                $order->updateAttributes(['state' => OrderPayState::PAY]);
                $user = FeUserModel::findOne($order->customer_id);
                $user->updateCounters(['score' => $order->obtain_score]);
                $order->activityPlayer->updateCounters([
                    'income' => $order->pay_price,
                    'gift_vote_number' => $order->obtain_vote_number,
                    'total_vote_number' => $order->obtain_vote_number,
                ]);
                $order->activity->updateCounters([
                    'vote_number' => 1,
                    'income' => $order->pay_price,
                ]);
            } else {
                Yii::info($model->errors);
                return false;
            }
        });
        return $response;
    }

    public function actionPaymentCallback($order)
    {
        $order = GiftOrderModel::findOne(['code' => $order]);
        if ($order->state == OrderPayState::PAY) {
            return 'ok';
        }
        $attributes = [
            'type' => VoteType::TYPE_GIFT,
            'user_id' => $order->customer_id,
            'activity_player_id' => $order->activity_id,
            'vote_number' => $order->obtain_vote_number,
            'order_id' => $order->id,
            'gift_id' => 0,
            'remote_ip' => $order->remote_ip,
        ];
        $model = new ActivityPlayerVoteRecordModel();
        $model->setAttributes($attributes);
        if ($model->save()) {
            $order->updateAttributes(['state' => OrderPayState::PAY]);
            $user = FeUserModel::findOne($order->customer_id);
            $user->updateCounters(['score' => $order->obtain_score]);
            $order->activityPlayer->updateCounters([
                'income' => $order->pay_price,
                'gift_vote_number' => $order->obtain_vote_number,
                'total_vote_number' => $order->obtain_vote_number,
            ]);
            $order->activity->updateCounters([
                'vote_number' => 1,
                'income' => $order->pay_price,
            ]);
        } else {
            return false;
        }
        return true;
    }
}
