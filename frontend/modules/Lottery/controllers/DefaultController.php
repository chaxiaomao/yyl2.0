<?php

namespace frontend\modules\Lottery\controllers;

use common\models\c2\entity\ActivityModel;
use common\models\c2\entity\LotteryModel;
use common\models\c2\entity\LotteryRecordModel;
use common\models\c2\statics\LotteryRecordState;
use common\models\c2\statics\Whether;
use frontend\components\behaviors\WechatAuthBehavior;
use frontend\controllers\ActivityController;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `lottery` module
 */
class DefaultController extends ActivityController
{

    public function behaviors()
    {
        return [
            'wechatFilter' => [
                'class' => WechatAuthBehavior::className()
            ]
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($code)
    {
        $this->layout = '/main-block';
        $activityModel = ActivityModel::findOne(['seo_code' => $code, 'is_released' => Whether::TYPE_YES]);
        if (is_null($activityModel) || $activityModel->is_released == Whether::TYPE_NO) {
            throw new NotFoundHttpException(Yii::t('app.c2', 'Activity disable.'));
        }
        $model = $activityModel->getActivityLottery();
        if ($model == false) {
            throw new NotFoundHttpException(Yii::t('app.c2', 'Lottery disable.'));
        }
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionLuckNumber()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $params = Yii::$app->request->get();
        $user = Yii::$app->user->identity;
        $lotteryModel = LotteryModel::findOne($params['id']);
        if ($user->score < $lotteryModel->need_score) {
            return ['code' => 502, 'message' => Yii::t('app.c2', 'Point Not Enough')];
        }
        $prize_arr = array();
        // 奖项数组
        // 是一个二维数组，记录了所有本次抽奖的奖项信息，
        // 其中id表示中奖等级，prize表示奖品，v表示中奖概率。
        // 注意其中的v必须为整数，你可以将对应的 奖项的v设置成0，即意味着该奖项抽中的几率是0，
        // 数组中v的总和（基数），基数越大越能体现概率的准确性。
        // 本例中v的总和为100，那么平板电脑对应的 中奖概率就是1%，
        // 如果v的总和是10000，那中奖概率就是万分之一了。
        foreach ($lotteryModel->lotteryPrizeRs as $key => $value) {
            array_push($prize_arr, [
                'id' => $value->prize_id,
                'prize' => $value->prize->name,
                'v' => $value->chance,
                'index' => $key,
            ]);
        }
        $arr = [];
        foreach ($prize_arr as $key => $val) {
            $arr[$val['index']] = $val['v'];
        }
        $rid = self::get_rand($arr); //根据概率获取奖项id的索引
        $lotteryRecordModel = new LotteryRecordModel();
        $lotteryRecordModel->loadDefaultValues();

        $lotteryRecordModel->setAttributes([
            'user_id' => $user->id,
            'code' => Yii::$app->security->generateRandomString(4),
            'lottery_name' => $lotteryModel->name,
            'prize_name' => $prize_arr[$rid]['prize'],
            'lottery_id' => $lotteryModel->id,
            'prize_id' => $prize_arr[$rid]['id'],
            'state' => LotteryRecordState::TYPE_NOT_DRAW,
        ]);
        if ($lotteryRecordModel->save()) {
            // 扣除积分
            $user->updateCounters(['score' => -($lotteryModel->need_score)]);
            // return ['code' => 000, 'message' => '操作成功', 'data' => ['rid' => array_search($rid, array_keys($arr)), 'point_num' => $point->point_num]];
            return ['code' => 000, 'message' => Yii::t('app.c2', 'Operated Success'), 'data' => ['rid' => $rid, 'point_num' => $user->score]];
        } else {
            return ['code' => 000, 'message' => Yii::t('app.c2', 'Operated Success'), 'data' => false];
        }
    }

    /*
     * 经典的概率算法，
     * $proArr是一个预先设置的数组，
     * 假设数组为：array(100,200,300，400)，
     * 开始是从1,1000 这个概率范围内筛选第一个数是否在他的出现概率范围之内，
     * 如果不在，则将概率空间，也就是k的值减去刚刚的那个数字的概率空间，
     * 在本例当中就是减去100，也就是说第二个数是在1，900这个范围内筛选的。
     * 这样 筛选到最终，总会有一个数满足要求。
     * 就相当于去一个箱子里摸东西，
     * 第一个不是，第二个不是，第三个还不是，那最后一个一定是。
     * 这个算法简单，而且效率非常 高，
     * 关键是这个算法已在我们以前的项目中有应用，尤其是大数据量的项目中效率非常棒。
     */
    function get_rand($proArr)
    {
        $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);

        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);

        return $result;
    }

}
