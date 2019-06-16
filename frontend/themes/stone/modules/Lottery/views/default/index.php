<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;

\frontend\assets\LuckDrawAsset::register($this);
?>

<style>
    html {
        height: 100%;
    }

    .body {
        position: fixed;
        left: 0;
        top: 0;
        background: url("/images/40.png");
        background-repeat: no-repeat;
        background-size: 100% 100%;
        width: 100%;
        height: 100%;
        z-index: -10;
    }

    .wrapper {
        text-align: center;
    }

    .typo a:hover {
        color: #fff;
    }

    .gb-turntable a.gb-turntable-btn {
        border: none;
    }

    .point-text {
        margin: 10px;
        color: white;
    }

    .content {
        color: #ffffff;
    }

    .content img {
        width: 100%;
    }

</style>

<p class="point-text"><?= Yii::t('app.c2', 'Current Point:') ?><span
            id="point"><?= Yii::$app->user->identity->score ?></span></p>
<div class="body"></div>


<div style="margin: 0 auto;width: 100%;margin-top: 140px;">

    <div class="wrapper typo" id="wrapper">

        <section id="turntable" class="gb-turntable">
            <div class="gb-turntable-container">
                <canvas class="gb-turntable-canvas" width="300px"
                        height="300px"><?= Yii::t('app.c2', 'Sorry! Browser Not Support.') ?></canvas>
            </div>

            <a class="gb-turntable-btn" href="javascript:;"><?= Yii::t('app.c2', 'Go Drawing') ?></a>
        </section>

    </div>
</div>


<div style="margin: 10px">
    <div class="content">
        <h4 style="text-align: center;font-weight: bold;color: white"><?= Yii::t('app.c2', 'Rules') ?></h4>
        <?= $model->content ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        gbTurntable.init({
            id: 'turntable',
            config: function (callback) {
                // 获取奖品信息
                // callback && callback(['11元红包','2元红包','3元红包','4元红包','5元红包','6元红包']);
                // callback && callback([{
                //     text: '1元红包',
                //     img: 'images/redpacket.png'
                // }, {
                //     text: '2元红包'
                // }, {
                //     text: '3元红包'
                // }, {
                //     text: '显示器',
                //     img: 'images/display.png'
                // }, {
                //     text: '5元红宝'
                // }, {
                //     text: '6元红宝'
                // }])
                callback && callback(<?= json_encode($model->getPrizesArr()) ?>)
            },
            getPrize: function (callback) {
                // 获取中奖信息
                // var num = Math.random() * 5 >>> 0, //奖品ID，从0开始
                //     chances = num; // 可抽奖次数
                // callback && callback([num, chances]);
                $.get('/lottery/default/luck-number', {'id': <?= $model->id ?>}, function (res) {
                    if (res.code == '000') {
                        // console.log(res.data);
                        var num = res.data.rid;
                        $('#point').html(res.data.point_num);
                        callback && callback([num, 9999]);
                    } else if (res.code == '502') {
                        alert(res.message);
                    }
                });
            },
            gotBack: function (data) {
                console.log(data);
                alert(data);
            }
        });
    }, false);
</script>

<?php
$staticsUrl = Url::toRoute('/player/default/activity-statics');
?>
<script type="application/javascript">
    wx.ready(function () {   //需在用户可能点击分享按钮前就先调用
        //shareData 参数记得为字符串类型
        var shareData = {
            title: '<?= $model->name?>',
            desc: '<?= Html::encode($model->content) ?>',//这里请特别注意是要去除html
            link: '<?= FRONTEND_BASE_URL . Yii::$app->request->url ?>',//域名必须JS安全域名
            imgUrl: '',
            success: function () {

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



