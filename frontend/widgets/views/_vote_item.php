<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/14 0014
 * Time: 下午 16:02
 */
?>
<li>
    <div class="row">
        <div class="col-xs-6">
            <img class="avatar" src="<?= $model->user->getDisplayAvatar() ?>">
            <span><?= $model->user->username ?></span>
        </div>
        <div class="col-xs-6" style="text-align: right">
            <?php if (is_null($model->gift_id)): ?>
                <span style="color: green;"><?= Yii::t('app.c2', 'inc{s1}', ['s1' => $model->vote_number]) ?></span>
            <?php else: ?>
                <span style="color: green;">
                    <?= Yii::t('app.c2', '{s1} inc{s2}', ['s1' => $model->giftOrder->gift_name, 's2' =>$model->vote_number ]) ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
</li>
