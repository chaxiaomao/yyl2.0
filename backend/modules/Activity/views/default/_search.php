<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c2\search\ActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'label') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'seo_code') ?>

    <?php // echo $form->field($model, 'start_at') ?>

    <?php // echo $form->field($model, 'end_at') ?>

    <?php // echo $form->field($model, 'vote_fre') ?>

    <?php // echo $form->field($model, 'area_limit') ?>

    <?php // echo $form->field($model, 'share_number') ?>

    <?php // echo $form->field($model, 'income_number') ?>

    <?php // echo $form->field($model, 'is_open_draw') ?>

    <?php // echo $form->field($model, 'is_check') ?>

    <?php // echo $form->field($model, 'start_id') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'is_released') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app.c2', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app.c2', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
