<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="activity-player-vote-record-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'type',
            'user_id',
            'activity_player_id',
            'vote_number',
            'gift_id',
            'order_id',
            'remote_ip',
            'state',
            'status',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

