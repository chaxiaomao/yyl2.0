<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="activity-player-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'type',
            'user_id',
            'income_number',
            'player_code',
            'title',
            'label',
            'content:ntext',
            'mobile_number',
            'free_vote_number',
            'gift_vote_number',
            'total_vote_number',
            'share_number',
            'view_number',
            'state',
            'status',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

