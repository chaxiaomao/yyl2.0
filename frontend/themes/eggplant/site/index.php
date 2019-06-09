<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/9 0009
 * Time: 下午 16:13
 */

use yii\helpers\Url;

// $assets = \frontend\themes\eggplant\AppAsset::register($this);
// $this->registerJsFile("{$assets->baseUrl}/js/swiper.min.js");
// $this->registerJsFile("{$assets->baseUrl}/js/leftTime.min.js");
// $this->registerCssFile("{$assets->baseUrl}/css/swiper.min.css");
?>

    <style>
        .item {
            text-align: center;
            background: rebeccapurple;
        }

        .players {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .players li {
            width: 50%;
            display: inline-block;
            padding: 10px;
        }

        .players li div {
            background-color: #ffe45c;
            height: 200px;
            text-align: center;
        }

        /*.players li:nth-child(2n+1) {*/
            /*float: right;*/
        /*}*/

        .players li:nth-child(2n+1) {
            float: left;
        }
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

    <div class="container-fluid" id="dateShow2">
        <h4><?= $activityModel->title ?></h4>
        <img class="icon" src="/images/common/clock.png">
        <span id="dataInfoShow_2">活动已结束</span>
        <span class="date-tiem-span d">00</span>天
        <span class="date-tiem-span h">00</span>时
        <span class="date-tiem-span m">00</span>分
        <span class="date-s-span s">00</span>秒
    </div>

    <div class="container-fluid">
        <ul class="players">
            <?php foreach ($playerModels as $item): ?>
                <li>
                    <div>
                        <img src="<?= $item->getThumbnailUrl() ?>">
                        <?= $item->title ?>
                    </div>
                </li>
            <?php endforeach; ?>
            <div style="clear: both"></div>
        </ul>
    </div>

<?php
$staticsUrl = Url::toRoute('/player/default/activity-statics');
$js = <<<JS
    var swiper = new Swiper('.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
        },
    });
    var clearTime = 0;
    function setDateImportFn(){
        //清除时间
        window.clearInterval(clearTime);
        /*== 获取数据 ==*/
        var data2={};
        //开始时间
        data2.startdate='<?= $activityModel->start_at ?>';
        //结束时间
        data2.enddate='<?= $activityModel->end_at ?>';
        //是否跳过开始
        data2.init=true;
        clearTime2=$.leftTime(data2,function(d){
            if(d.status){
                var dateShow1=$("#dateShow2");
                dateShow1.find(".d").html(d.d);
                dateShow1.find(".h").html(d.h);
                dateShow1.find(".m").html(d.m);
                dateShow1.find(".s").html(d.s);
                switch(d.step){
                    case 1:
                    $("#dataInfoShow_2").html("距离开始时间");
                    break;
                    case 2:
                    $("#dataInfoShow_2").html("距活动结束时间");
                    break;
                    case 3:
                    $("#dataInfoShow_2").html("活动已结束");
                    break;
                    default: 
                    $("#dataInfoShow_2").html("");
                     break;
                }
            }
        }, true);
    }
//初始化
setDateImportFn();
JS;
$this->registerJS($js);
?>