<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/14 0014
 * Time: 上午 10:56
 */

namespace common\helpers;


use common\models\c2\entity\ActivityPlayerModel;
use yii\redis\Connection;

class VoteHelper
{

    /**
     * @param $redis Connection
     * @param $playerModel ActivityPlayerModel
     */
    public static function setActivityPlayerRank($redis, $playerModel)
    {
        $kActivity = K_ACTIVITY_RANK . $playerModel->activity_id;
        $kPlayer = K_PLAYER . $playerModel->id;
        $redis->executeCommand('ZADD', [$kActivity, $playerModel->total_vote_number, $kPlayer]);
    }
}