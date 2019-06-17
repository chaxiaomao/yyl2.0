<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/14 0014
 * Time: 下午 13:24
 */

$this->title = $activityModel->title;
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

    <div class="row statics white-bg">
        <div class="col-xs-4">
            <div>
                <p><?= Yii::t('app.c2', 'Total View') ?></p>
                <?= $activityModel->view_number ?>
            </div>
        </div>
        <div class="col-xs-4">
            <div>
                <p><?= Yii::t('app.c2', 'Total Vote') ?></p>
                <?= $activityModel->vote_number ?>
            </div>
        </div>
        <div class="col-xs-4">
            <div>
                <p><?= Yii::t('app.c2', 'Total Share') ?></p>
                <?= $activityModel->share_number ?>
            </div>
        </div>

    </div>

    <?= \frontend\widgets\CounterDown::widget(['activityModel' => $activityModel]) ?>

    <div class="box">
        <?php foreach ($playerModels as $item): ?>
            <div class="box-item">
                <div class="card">
                    <img class="card__picture" src="<?= $item->getThumbnailUrl() ?>" alt="">
                    <div class="card-infos">

                        <p class="card__text">
                            <?= $item->title ?>
                        </p>
                        <div class="card__title">
                            <?= Yii::t('app.c2', '{s1} Votes', ['s1' => $item->total_vote_number]) ?>
                            <span class="card__id"></span>
                            <a href="/player/<?= $item->player_code ?>"
                               class="myButton"><?= Yii::t('app.c2', 'Vote It') ?></a>
                            <div style="clear: both"></div>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div style="text-align: center">
        <?= \yii\helpers\Html::a(Yii::t('app.c2', 'More Players'), ['/players', 'vasc' => $activityModel->seo_code], ['class' => 'btn btn-link more']); ?>
    </div>

</div>

<?php

$js = <<<JS

// document.querySelector('#sortable').sortablejs()
JS;
$this->registerJs($js);
?>

<!--<script type="text/javascript">-->
<!--    $(function () {-->
<!--        document.querySelector('#sortable').sortablejs()-->
<!--    });-->
<!--</script>-->