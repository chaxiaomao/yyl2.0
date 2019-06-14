<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/14 0014
 * Time: 下午 13:24
 */
?>

<style type="text/css">


</style>

<?= \frontend\widgets\PhotosSwiper::widget(['model' => $activityModel]) ?>

<div class="container-fluid">

    <?= \frontend\widgets\PlayerSearch::widget([]) ?>

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

    <div id="sortable" class="sjs-default">

        <?php //$rank = 1 ?>
        <?php foreach ($playerModels as $item): ?>
            <div data-sjsel="flatty">
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

        <div style="clear: both"></div>

    </div>
</div>



<script type="text/javascript">
    $(function () {
        document.querySelector('#sortable').sortablejs()
    });
</script>