<?php


?>
    <style>
    </style>

    <div class="container-fluid" style="margin-top: 10px">
        <div class="panel" style="margin-bottom: 0;">
            <div class="panel-body">
                <p style="font-weight: bold;color: orange"><?= Yii::t('app.c2', 'ID:') . $playerModel->player_code; ?></p>
                <?= $playerModel->title; ?>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="margin-top: 10px">
        <div class="panel" style="margin-bottom: 0;">
            <div class="row statics">
                <div class="col-xs-3">
                    <div class="statics-item">
                        <p><?= Yii::t('app.c2', 'Vote Number') ?></p>
                        <span id="total-vote-number"><?= $playerModel->total_vote_number ?></span>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="statics-item">
                        <p><?= Yii::t('app.c2', 'Diff Before Player Vote') ?></p>
                        <?= $playerModel->total_vote_number ?>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="statics-item">
                        <p><?= Yii::t('app.c2', 'Current Rank') ?></p>
                        <?= $playerModel->share_number ?>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="statics-item">
                        <p><?= Yii::t('app.c2', 'Diff After Player Vote') ?></p>
                        <?= $playerModel->share_number ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="content panel" style="padding: 10px;margin-top: 10px">

            <?= $playerModel->content ?>

            <div class="btn-group btn-group-justified" role="group" aria-label="ab">
                <div class="btn-group" role="group">
                    <button type="button" id="btn-free-vote"
                            class="btn btn-warning"><?= Yii::t('app.c2', 'Free Vote') ?></button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="btn-gift-vote"
                            class="btn btn-warning"><?= Yii::t('app.c2', 'Gift Vote') ?></button>
                </div>
            </div>
        </div>

        <div class="content" style="color: #ffffff">

            <h4 style="text-align: center;font-weight: bold"><?= Yii::t('app.c2', 'Activity Introduce') ?></h4>
            <?= $playerModel->activity->content ?>
        </div>


    </div>

<?php

\yii\bootstrap\Modal::begin([
    'id' => 'content-modal',
    'header' => '<p class="modal-title"></p>',
    // 'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]);

\yii\bootstrap\Modal::end();

$js = <<<JS
var swiper = new Swiper('.swiper-container', {
        pagination: {
            // el: '.swiper-pagination',
            // observer: true,//修改swiper自己或子元素时，自动初始化swiper
            // observeParents: true//修改swiper的父元素时，自动初始化swiper
        },
    });

$('#btn-free-vote').on('click', function(e) {
  $.post('/site/vote', {id:"{$playerModel->id}"}, function(res) {
    if (res) {
        if (res._meta.result === '0000') {
            $('#total-vote-number').html(res._data.total_vote_number);
        }
        $('#content-modal').find('.modal-title').html('提示');
        $('#content-modal').modal('show').find('.modal-body').html(res._meta.message);
    }
  })
})

$('#btn-gift-vote').on('click', function(e) {
  $('#content-modal').find('.modal-title').html('活动重在参与，意在宣传推广，不提倡购买!<br>温馨提示：加油支付失败时，请重新登陆后再次为Ta加油');
  $('#content-modal').modal('show').find('.modal-body').html('加载中...').load();
})

JS;
$this->registerJs($js);

?>