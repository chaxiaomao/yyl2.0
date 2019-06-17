<?php

use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

$this->title = $playerModel->title;
$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();
$rankResult = $playerModel->getActivityRank();
?>
<style>
    .of {
        font-weight: bold;
        color: orange
    }

    .poster {
        width: 100%;
        position: fixed;
        left: 0;
        bottom: 42px;
        background-color: #000000; /* IE6和部分IE7内核的浏览器(如QQ浏览器)下颜色被覆盖 */
        background-color: rgba(0, 0, 0, 0.2); /* IE6和部分IE7内核的浏览器(如QQ浏览器)会读懂，但解析为透明 */
        text-align: center;
        z-index: 99;
    }

    .poster a {
        width: 60%;
        margin: 10px;
    }

</style>

<?php

\yii\bootstrap\Modal::begin([
    'id' => 'content-modal',
    'header' => '<p class="modal-title"></p>',
    // 'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]);

\yii\bootstrap\Modal::end();

?>

<?= \frontend\widgets\Loading::widget([]) ?>

<?php Pjax::begin(['id' => $model->getDetailPjaxName(), 'formSelector' => $model->getBaseFormName(true), 'enablePushState' => false, 'clientOptions' => [
    'skipOuterContainers' => true
]]) ?>

<?php $js = "";
// $js .= "jQuery('{$model->getDetailPjaxName(true)}').off('pjax:send').on('pjax:send', function(){jQuery.fn.czaTools('showLoading', {selector:'{$model->getDetailPjaxName(true)}', 'msg':''});});\n";
// $js .= "jQuery('{$model->getDetailPjaxName(true)}').off('pjax:complete').on('pjax:complete', function(){jQuery.fn.czaTools('hideLoading', {selector:'{$model->getDetailPjaxName(true)}'});});\n";
$js .= "jQuery('{$model->getDetailPjaxName(true)}').off('pjax:send').on('pjax:send', function(){window.top.window.showLoading();});\n";
$js .= "jQuery('{$model->getDetailPjaxName(true)}').off('pjax:complete').on('pjax:complete', function(){window.top.window.hideLoading();});\n";
$this->registerJs($js);
?>

<?php
$form = ActiveForm::begin([
    'action' => ['/player', 'player_code' => $playerModel->player_code],
    'options' => [
        'id' => $model->getBaseFormName(),
        'data-pjax' => true,
    ]]);
?>

<div class="<?= $model->getPrefixName('form') ?>">
    <div class="container-fluid" style="margin-top: 10px">

        <?php if (Yii::$app->session->hasFlash($messageName)): ?>
            <?php
            $js = "$('#content-modal').find('.modal-title').html('提示');
                $('#content-modal').modal('show').find('.modal-body').html('" . Yii::$app->session->getFlash($messageName)[0] . "');";
            $this->registerJs($js);
            ?>
        <?php endif; ?>

        <?php
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 2,
            'attributes' => [
                'type' => ['type' => Form::INPUT_HIDDEN, 'options' => ['value' => \common\models\c2\statics\VoteType::TYPE_FREE]],
                'user_id' => ['type' => Form::INPUT_HIDDEN, 'options' => ['value' => Yii::$app->user->id]],
                'activity_player_id' => ['type' => Form::INPUT_HIDDEN, 'options' => ['value' => $playerModel->id]],
                'vote_number' => ['type' => Form::INPUT_HIDDEN, 'options' => ['value' => 1]],
                'gift_id' => ['type' => Form::INPUT_HIDDEN, 'options' => ['placeholder' => $model->getAttributeLabel('gift_id')]],
                'order_id' => ['type' => Form::INPUT_HIDDEN, 'options' => ['placeholder' => $model->getAttributeLabel('order_id')]],
                'remote_ip' => ['type' => Form::INPUT_HIDDEN, 'options' => ['value' => Yii::$app->request->userIP]],
                'state' => ['type' => Form::INPUT_HIDDEN, 'options' => [],],
                'status' => ['type' => Form::INPUT_HIDDEN, 'options' => []],
            ]
        ]);
        ?>

        <div class="panel" style="margin-bottom: 10px;">
            <div class="panel-body">
                <div class="row">
                    <p class="col-xs-6 of">
                        <?= Yii::t('app.c2', 'ID:') . $playerModel->player_code; ?>
                    </p>
                    <p class="col-xs-6 of" style="text-align: right">
                        <span id="total-vote-number"><?= $playerModel->total_vote_number ?></span><?= Yii::t('app.c2', 'Vote') ?>
                    </p>
                </div>
                <?= $playerModel->title; ?>
            </div>
        </div>

        <div class="panel" style="margin-bottom: 10px;">
            <div class="row statics">
                <div class="col-xs-4">
                    <div class="statics-item">
                        <p><?= Yii::t('app.c2', 'Diff Before Player Vote') ?></p>
                        <?= $rankResult['beforeVoteNumber'] . Yii::t('app.c2', 'Vote') ?>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="statics-item">
                        <p><?= Yii::t('app.c2', 'Current Rank') ?></p>
                        <?= $rankResult['currentRank'] . Yii::t('app.c2', 'th') ?>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="statics-item">
                        <p><?= Yii::t('app.c2', 'Diff After Player Vote') ?></p>
                        <?= $rankResult['afterVoteNumber'] . Yii::t('app.c2', 'Vote') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel" style="margin-top: 10px">

            <div class="panel-body">

                <?= \frontend\widgets\PhotosSwiper::widget(['model' => $playerModel]) ?>

                <?= $playerModel->content ?>

                <div class="btn-group btn-group-justified" role="group" aria-label="ab">
                    <div class="btn-group" role="group">
                        <?= \yii\helpers\Html::submitButton(Yii::t('app.c2', 'Free Vote'), ['class' => 'btn btn-warning']) ?>
                        <!--                    <button type="button" id="btn-free-vote"-->
                        <!--                            class="btn btn-warning">-->
                        <? //= Yii::t('app.c2', 'Free Vote') ?><!--</button>-->
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" id="btn-gift-vote"
                                class="btn btn-warning"><?= Yii::t('app.c2', 'Gift Vote') ?></button>
                    </div>
                    <?php
                    $js = "$('#btn-gift-vote').on('click', function(e) {jQuery('#gifts').toggle();})";
                    $this->registerJs($js);
                    ?>
                </div>

                <div id="gifts" style="display: none;margin-top: 5px;">
                    <?= \frontend\widgets\GiftsGridView::widget(['activityModel' => $playerModel->activity, 'playerId' => $playerModel->id]) ?>
                    <div style="text-align: center;font-size: 12px;color: red">
                        活动重在参与，意在宣传推广，不提倡购买!<br>温馨提示：加油支付失败时，请重新登陆后再次为Ta加油
                    </div>
                </div>

            </div>

        </div>

        <div class="panel">
            <div class="panel-body">
                <?= \frontend\widgets\VotedScroll::widget(['player' => $playerModel]) ?>
            </div>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>

<div class="container-fluid" style="margin-top: 10px">
    <div class="content" style="color: #ffffff">

        <h4 style="text-align: center;font-weight: bold"><?= Yii::t('app.c2', 'Activity Introduce') ?></h4>
        <?= $playerModel->activity->content ?>
    </div>
</div>

<div class="poster">
    <?= \yii\helpers\Html::a(Yii::t('app.c2', 'Generate Poster'), '/poster/' . $playerModel->player_code, ['class' => 'btn btn-success']) ?>
</div>

<?php

$js = <<<JS

// $('#btn-free-vote').on('click', function(e) {
//   $.ajax({
//     type: 'post',
//     url: '/site/vote',
//     dataType: 'json',
//     data: {id:"{$playerModel->id}"},
//     beforeSend: function() {
//           window.top.window.showLoading();
//     },
//     success: function(res) {
//           if (res) {
//             if (res._meta.result === '0000') {
//                 $('#total-vote-number').html(res._data.total_vote_number);
//             }
//             $('#content-modal').find('.modal-title').html('提示');
//             $('#content-modal').modal('show').find('.modal-body').html(res._meta.message);
//         }
//     },
//     error: function(res) {
//       if (res.status === 500) {
//           $('#content-modal').find('.modal-title').html('提示');
//           // $('#content-modal').modal('show').find('.modal-body').html(res.responseText);
//           $('#content-modal').modal('show').find('.modal-body').html('服务器开小差');
//       } 
//     },
//     complete: function() {
//         window.top.window.hideLoading();
//     }
//   })
//  
// })

JS;
// $this->registerJs($js);

?>

<script type="application/javascript">


</script>
