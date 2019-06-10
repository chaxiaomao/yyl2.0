<?php
namespace frontend\components\actions;
use common\models\c2\entity\ActivityPlayerModel;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/10 0010
 * Time: 下午 15:34
 */

class VoteAction extends \yii\base\Action
{
    public $playerId;

    public function run()
    {
        $playerModel = ActivityPlayerModel::findOne($this->playerId);
        $activityModel = $playerModel->activity;
        // $user = \Yii::$app->user->identity;
        $key = 'user:' . 1 . '/' . 'player:' . $playerModel->id . '/' . date('Y-m-d', time());
        $redis = \Yii::$app->redis;
        $votedNum = $redis->get($key);
        if ($votedNum < $activityModel->vote_number_limit) {
            $redis->incr($key);
            $redis->expire($key, 60 * 60 * 24);
            $playerModel->updateCounters(['free_vote_number' => 1]);
            $activityModel->updateCounters(['vote_number' => 1]);
            // $user->updateCounters(['score' => 1]);
        } else {
            var_dump('3次警告!');
        }
    }
}