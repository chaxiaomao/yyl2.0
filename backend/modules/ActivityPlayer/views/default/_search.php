<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c2\search\ActivityPlayerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-player-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'income_number') ?>

    <?= $form->field($model, 'player_code') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'label') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'mobile_number') ?>

    <?php // echo $form->field($model, 'free_vote_number') ?>

    <?php // echo $form->field($model, 'gift_vote_number') ?>

    <?php // echo $form->field($model, 'total_vote_number') ?>

    <?php // echo $form->field($model, 'share_number') ?>

    <?php // echo $form->field($model, 'view_number') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app.c2', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app.c2', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
