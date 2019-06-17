<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/17 0017
 * Time: 下午 12:06
 */

?>


<div class="panel" style="margin-top: 10px;">
    <div class="panel-body">
        <a href="<?= '/player/' . $model->player_code ?>">
            <h4><?= $model->title ?></h4>
            <?php if ($model->state == \common\models\c2\statics\ActivityPlayerState::STATE_NOT_CHECK): ?>
                <span class="label label-default"><?= \common\models\c2\statics\ActivityPlayerState::getLabel($model->state) ?></span>
            <?php elseif ($model->state == \common\models\c2\statics\ActivityPlayerState::STATE_CHECKED): ?>
                <span class="label label-success"><?= \common\models\c2\statics\ActivityPlayerState::getLabel($model->state) ?></span>
            <?php endif; ?>
        </a>

    </div>
</div>
