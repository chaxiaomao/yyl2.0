<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/17 0017
 * Time: 上午 9:50
 */

?>

<div class="card">
    <img class="card__picture" src="<?= $model->getThumbnailUrl() ?>" alt="">
    <div class="card-infos">

        <p class="card__text">
            <?= $model->title ?>
        </p>
        <div class="card__title">
            <?= Yii::t('app.c2', '{s1} Votes', ['s1' => $model->total_vote_number]) ?>
            <span class="card__id"></span>
            <a href="/player/<?= $model->player_code ?>"
               class="myButton"><?= Yii::t('app.c2', 'Vote It') ?></a>
            <div style="clear: both"></div>
        </div>

    </div>
</div>
