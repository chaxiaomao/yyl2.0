<?php

namespace common\helpers;

use common\models\c2\entity\ActivityPlayerModel;
use yii\redis\Connection;

class VoteHelper
{

    /**
     * @param $redis Connection
     * @param $playerModel ActivityPlayerModel
     * @throws \yii\db\Exception
     */
    public static function setActivityPlayerRank($redis, $playerModel)
    {
        $kActivity = K_ACTIVITY_RANK . $playerModel->activity_id;
        $kPlayer = K_PLAYER . $playerModel->id;
        $redis->executeCommand('ZADD', [$kActivity, $playerModel->total_vote_number, $kPlayer]);
    }

    public static function getVotedMember($userId, $playerId)
    {
        return K_VOTED . $userId . '_' . $playerId . '_' . date('Y-m-d', time());
    }

}
