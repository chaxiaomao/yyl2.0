<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/17 0017
 * Time: 上午 9:49
 */

?>


<style type="text/css">

    .box {
        display: flex;
        flex-wrap: wrap;
    }

    .box-item {
        width: 50%;
        padding: 5px;
    }

    .box-item .player {
        background-color: white;
    }

    .box .box-item:nth-child(2n) {
        padding-right: 0;
    }

    .box .box-item:nth-child(2n+1) {
        padding-left: 0;
    }

    .more {
        color: #ffffff;
    }

</style>

<?= \frontend\widgets\PhotosSwiper::widget(['model' => $activityModel]) ?>

<div class="container-fluid">

    <?= \frontend\widgets\PlayerSearch::widget(['activityModel' => $activityModel]) ?>

    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'box'],
        'itemOptions' => ['class' => 'box-item'],
        'itemView' => '_player_item',
        'summary' => '',
        // 'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
        'pager' => [
            //'options' => ['class' => 'hidden'],//关闭分页（默认开启）
            'maxButtonCount' => 6,//最多显示几个分页按钮
            // 'firstPageLabel' => '首页',
            'prevPageLabel' => Yii::t('app.c2', 'Last Page'),
            'nextPageLabel' => Yii::t('app.c2', 'Next Page'),
            // 'lastPageLabel' => '尾页'
        ]
    ]);

    ?>
</div>
