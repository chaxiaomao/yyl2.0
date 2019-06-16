<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/15
 * Time: 21:49
 */

?>
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
