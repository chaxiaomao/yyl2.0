<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


?>
<div class="gift-model-detail">

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'name',
            'label',
            'activity_id',
            'code',
            'obtain_score',
            'obtain_vote_number',
            'price',
            'position',
            'status',
            'created_at',
            'updated_at',
    ],
    ]) ?>

</div>

