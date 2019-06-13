<?php

$this->title = $playerModel->title;

$rankResult = $playerModel->getActivityRank();
?>
<style>
    .of {
        font-weight: bold;
        color: orange
    }

    .overlay {
        position: absolute;
        top: 0px;
        left: 0px;
        z-index: 10001;
        display: none;
        filter: alpha(opacity=20);
        background-color: #eeeeee;
        opacity: 0.2;
        -moz-opacity: 0.2;
    }

    .loading-tip {
        z-index: 10002;
        position: fixed;
        display: none;
    }

    .loading-tip img {
        width: 100px;
    }

</style>

<!-- 遮罩层DIV -->
<div id="overlay" class="overlay"></div>
<!-- Loading提示 DIV -->
<div id="loadingTip" class="loading-tip">
    <img src="/images/common/loading.gif"/>
</div>

<div class="container-fluid" style="margin-top: 10px">
    <div class="panel" style="margin-bottom: 0;">
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
</div>

<div class="container-fluid" style="margin-top: 10px">
    <div class="panel" style="margin-bottom: 0;">
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

        <div id="gifts" style="display: none;margin-top: 5px;">
            <?= \frontend\widgets\GiftsGridView::widget(['activityModel' => $playerModel->activity, 'playerId' => $playerModel->id]) ?>
            <div style="text-align: center;font-size: 12px;color: red">
                活动重在参与，意在宣传推广，不提倡购买!<br>温馨提示：加油支付失败时，请重新登陆后再次为Ta加油
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
  // $.post('/site/vote', {id:"{$playerModel->id}"}, function(res) {
  //   if (res) {
  //       if (res._meta.result === '0000') {
  //           $('#total-vote-number').html(res._data.total_vote_number);
  //       }
  //       $('#content-modal').find('.modal-title').html('提示');
  //       $('#content-modal').modal('show').find('.modal-body').html(res._meta.message);
  //   }
  // })
  
  $.ajax({
    type: 'post',
    url: '/site/vote',
    dataType: 'json',
    data: {id:"{$playerModel->id}"},
    beforeSend: function() {
          window.top.window.showLoading();
    },
    success: function(res) {
          if (res) {
            if (res._meta.result === '0000') {
                $('#total-vote-number').html(res._data.total_vote_number);
            }
            $('#content-modal').find('.modal-title').html('提示');
            $('#content-modal').modal('show').find('.modal-body').html(res._meta.message);
        }
    },
    error: function(res) {
      if (res.status === 500) {
          $('#content-modal').find('.modal-title').html('提示');
          // $('#content-modal').modal('show').find('.modal-body').html(res.responseText);
          $('#content-modal').modal('show').find('.modal-body').html('服务器开小差');
      } 
    },
    complete: function() {
        window.top.window.hideLoading();
    }
  })
  
})

$('#btn-gift-vote').on('click', function(e) {
  // $('#content-modal').find('.modal-title').html('活动重在参与，意在宣传推广，不提倡购买!<br>温馨提示：加油支付失败时，请重新登陆后再次为Ta加油');
  // $('#content-modal').modal('show').find('.modal-body').html('加载中...').load();
  $('#gifts').toggle();
})

JS;
$this->registerJs($js);

?>

<script type="application/javascript">
    // 浏览器兼容 取得浏览器可视区高度
    function getWindowInnerHeight() {
        var winHeight = window.innerHeight
            || (document.documentElement && document.documentElement.clientHeight)
            || (document.body && document.body.clientHeight);
        return winHeight;

    }

    // 浏览器兼容 取得浏览器可视区宽度
    function getWindowInnerWidth() {
        var winWidth = window.innerWidth
            || (document.documentElement && document.documentElement.clientWidth)
            || (document.body && document.body.clientWidth);
        return winWidth;

    }

    /**
     * 显示遮罩层
     */
    function showOverlay() {
        // 遮罩层宽高分别为页面内容的宽高
        $('.overlay').css({'height': $(document).height(), 'width': $(document).width()});
        $('.overlay').show();
    }

    /**
     * 显示Loading提示
     */
    function showLoading() {
        // 先显示遮罩层
        showOverlay();
        // Loading提示窗口居中
        $("#loadingTip").css('top',
            (getWindowInnerHeight() - $("#loadingTip").height()) / 2 + 'px');
        $("#loadingTip").css('left',
            (getWindowInnerWidth() - $("#loadingTip").width()) / 2 + 'px');

        $("#loadingTip").show();
        $(document).scroll(function () {
            return false;
        });
    }

    /**
     * 隐藏Loading提示
     */
    function hideLoading() {
        $('.overlay').hide();
        $("#loadingTip").hide();
        $(document).scroll(function () {
            return true;
        });
    }

</script>
