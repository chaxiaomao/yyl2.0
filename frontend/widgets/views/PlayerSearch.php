<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/11 0011
 * Time: 上午 9:31
 */

use yii\helpers\Html;

?>


<?php echo Html::beginForm('/p', 'post', ['style' => 'margin:10px 0']); ?>
<div class="row">
    <div class="col-xs-8" style="padding-right: 0;">
        <?= Html::input('text', 'player_code', '', [
            'class' => 'search-inp', 'placeholder' => Yii::t('app.c2', 'Input player code or name to search...')
        ]) ?>
    </div>

    <div class="col-xs-4">
        <?php
        echo Html::submitButton(
            Yii::t('app.c2', 'Search'),
            ['class' => 'btn btn-warning search-btn']
        );
        ?>
    </div>
    <?php
    // echo '<div style="clear: both"></div>';
    echo Html::endForm();
    ?>
</div>
