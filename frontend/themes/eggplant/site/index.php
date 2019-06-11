<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/9 0009
 * Time: 下午 16:13
 */

use frontend\widgets\PlayerSearch;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $activityModel->title;

// $assets = \frontend\themes\eggplant\AppAsset::register($this);
// $this->registerJsFile("{$assets->baseUrl}/js/swiper.min.js");
// $this->registerJsFile("{$assets->baseUrl}/js/leftTime.min.js");
// $this->registerCssFile("{$assets->baseUrl}/css/swiper.min.css");
?>

<style>


</style>

<!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($activityModel->getPosters() as $item): ?>
            <div class="swiper-slide"><img class="w100" src="<?= $item ?>"></div>
        <?php endforeach; ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>

<div class="container-fluid">
    <?= PlayerSearch::widget([]) ?>

    <div class="row statics white-bg">
        <div class="col-xs-4">
            <div class="statics-item">
                <p><?= Yii::t('app.c2', 'Total View') ?></p>
                <?= $activityModel->view_number ?>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="statics-item">
                <p><?= Yii::t('app.c2', 'Total Vote') ?></p>
                <?= $activityModel->vote_number ?>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="statics-item">
                <p><?= Yii::t('app.c2', 'Total Share') ?></p>
                <?= $activityModel->share_number ?>
            </div>
        </div>

    </div>

    <?= \frontend\widgets\CounterDown::widget(['activityModel' => $activityModel]) ?>


    <ul class="players" style="padding: 10px;">
        <?php $rank = 1 ?>
        <?php foreach ($playerModels as $item): ?>
            <li>
                <div class="main-bg-color main-font-color">

                    <div class="player-photo" style="background-image: url(<?= $item->getThumbnailUrl() ?>)"></div>
                    <span class="reverse-main-bg-color"><?= Yii::t('app.c2', 'th {s1}', ['s1' => $rank++]) ?></span>
                    <div style="padding: 4px">
                        <p><?= $item->title ?></p>
                        <div class="btn-group btn-group-justified" role="group" aria-label="ab">
                            <div class="btn-group" role="group">
                                <button type="button"
                                        class="btn btn-warning"><?= Yii::t('app.c2', '{s1} Votes', ['s1' => $item->total_vote_number]) ?></button>
                            </div>
                            <div class="btn-group" role="group">
                                <a href="/player/<?= $item->player_code ?>"
                                   class="btn btn-warning"><?= Yii::t('app.c2', 'Vote It') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
        <div style="clear: both"></div>
    </ul>
</div>



<?php
$js = <<<JS
    var swiper = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
            observer: true,//修改swiper自己或子元素时，自动初始化swiper
            observeParents: true//修改swiper的父元素时，自动初始化swiper
        },
    });
JS;
$this->registerJS($js);
?>

<script type="application/javascript">

    wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
        //shareData 参数记得为字符串类型
        var shareData = {
            title: '<?= $activityModel->title ?>',
            desc: '<?= Html::encode($activityModel->title) ?>',//这里请特别注意是要去除html
            link: '<?= FRONTEND_BASE_URL . Yii::$app->request->url ?>',//域名必须JS安全域名
            imgUrl: '<?= $activityModel->getThumbnailUrl() ?>',
            success: function () {
                $.post('/activity-share', {'id': '<?= $activityModel->id ?>',}, function (res) {
                    console.log(1);
                })
            },
            cancel: function () {
                console.log('cancel')
            }
        };

        if (wx.onMenuShareAppMessage) { //微信文档中提到这两个接口即将弃用，故判断
            wx.onMenuShareAppMessage(shareData);//1.0 分享到朋友
            wx.onMenuShareTimeline(shareData);//1.0分享到朋友圈
        } else {
            wx.updateAppMessageShareData(shareData);//1.4 分享到朋友
            wx.updateTimelineShareData(shareData);//1.4分享到朋友圈
        }

    });
</script>
