<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/9 0009
 * Time: 下午 16:13
 */

use yii\helpers\Html;
use yii\helpers\Url;

// $assets = \frontend\themes\eggplant\AppAsset::register($this);
// $this->registerJsFile("{$assets->baseUrl}/js/swiper.min.js");
// $this->registerJsFile("{$assets->baseUrl}/js/leftTime.min.js");
// $this->registerCssFile("{$assets->baseUrl}/css/swiper.min.css");
?>

    <style>

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
            text-align: center;
            position: relative;
        }

        .players li span {
            position: absolute;
            top: 0;
            left: 0;
            padding: 4px;
        }

        .players li p {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            height: 40px;
            -webkit-box-orient: vertical;
        }

        /*.players li:nth-child(2n+1) {*/
        /*float: right;*/
        /*}*/

        .players li:nth-child(2n+1) {
            float: left;
        }

        .search-inp {
            border: 1px solid #eee;
            border-radius: 4px;
            height: 43px;
            margin-right: 10px;
        }

        .search-btn {
            width: 100px;
            height: 43px;
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

        <?php echo Html::beginForm('/p', 'post', ['style' => 'margin-top:10px']); ?>
        <?= Html::input('text', 'player_code', '', [
                'class' => 'search-inp col-xs-8', 'placeholder' => Yii::t('app.c2', 'Input player code or name to search...')
        ]) ?>
        <?php
        echo Html::submitButton(
            Yii::t('app.c2', 'Search'),
            ['class' => 'btn btn-warning search-btn col-xs-4']
        );
        echo '<div style="clear: both"></div>';
        echo Html::endForm();
        ?>

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
            <?php $rank = 1 ?>
            <?php foreach ($playerModels as $item): ?>
                <li>
                    <div class="main-bg-color main-font-color">
                        <img class="w100" src="<?= $item->getThumbnailUrl() ?>">
                        <span class="main-bg-color"><?= Yii::t('app.c2', 'th {s1}', ['s1' => $rank++]) ?></span>
                        <p><?= $item->title ?></p>
                        <div style="padding: 4px" class="btn-group btn-group-justified" role="group" aria-label="ab">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-warning"><?= Yii::t('app.c2', '{s1} Votes', ['s1' => $item->total_vote_number]) ?></button>
                            </div>
                            <div class="btn-group" role="group">
                                <a href="/player/<?= $item->player_code ?>" class="btn btn-warning"><?= Yii::t('app.c2', 'Vote It') ?></a>
                            </div>
                        </div>
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