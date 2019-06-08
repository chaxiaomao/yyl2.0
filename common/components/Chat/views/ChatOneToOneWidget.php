<?php

use yii\helpers\Html;
use common\components\Chat\ChatAsset;

/** \yii\web\View $this */
ChatAsset::register($this);
?>
<div class="row">
    <div role="navigation" class="col-md-12">
        <div id="chat-room-list" class="list-group">
            <div class="list-group-container"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 chat-wrapper">
        <div class="jumbotron chat-container"></div>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
            <?= Html::textInput('chat_message', '', ['id' => 'chat-message', 'class' => 'form-control', 'placeholder' => Yii::t('app.c2', "Enter Message")]) ?>
            <div class="input-group-btn">
                <button type="button" id="send-msg" class="btn btn-primary"><?= Yii::t('app.c2', 'Send'); ?></button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div role="navigation" class="col-md-12">
        <div id="user-list" class="list-group">
            <h4><i class="fa fa-users"></i><?= Yii::t('app.c2', 'Online Users'); ?></h4>
            <div class="list-group-container"></div>
        </div>
    </div>
</div>
<?= $this->render('user'); ?>
<?= $this->render('room'); ?>
<?php if ($add_room): ?>
    <?= $this->render('add_room'); ?>
<?php endif; ?>
<?= $this->render('message'); ?>
<?php if (!$auth): ?>
    <?= $this->render('add_user'); ?>
<?php endif; ?>
