<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="activity-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'type',
            'title',
            'label',
            'content:ntext',
            'seo_code',
            'start_at',
            'end_at',
            'vote_fre',
            'area_limit',
            'share_number',
            'income_number',
            'is_open_draw',
            'is_check',
            'start_id',
            'created_by',
            'updated_by',
            'is_released',
            'status',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

