<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/14 0014
 * Time: 下午 15:29
 */
?>
<style>

    .vote-scroll {
        height: 260px;
        margin: 0 auto;
        line-height: 26px;
        font-size: 12px;
        overflow: hidden;
    }

    .vote-scroll li {
        /*height: 26px;*/
        /*margin-left: 25px;*/
        padding: 5px 0;
        border-bottom: 1px solid #eeeeee;
    }


    .avatar {
        width: 30px;
        border-radius: 15px;
    }

</style>
<p style="color: deeppink;"><?= Yii::t('app.c2', 'Newest voted.') ?></p>
<div id="vote-scroll" class="vote-scroll">
    <ul>
        <?php
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'media-list'],
            'itemView' => '_vote_item',
            // 'summary' => '',
            'layout' => '{items}',
            'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
        ]);

        ?>
    </ul>

</div>
<script>
    $(function () {
        $('#vote-scroll').myScroll({
            speed:40, //数值越大，速度越慢
        });
    });
</script>