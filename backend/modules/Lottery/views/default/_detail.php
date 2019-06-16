<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="lottery-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'type',
            'name',
            'label',
            'activity_id',
            'need_score',
            'created_by',
            'updated_by',
            'content:ntext',
            'status',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

