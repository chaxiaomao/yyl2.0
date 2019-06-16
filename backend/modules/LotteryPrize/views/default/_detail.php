<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="lottery-prize-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'type',
            'name',
            'label',
            'lottery_id',
            'drawn_rate',
            'code',
            'store_number',
            'position',
            'status',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

