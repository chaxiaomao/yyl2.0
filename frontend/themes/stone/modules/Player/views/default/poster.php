<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/16
 * Time: 19:50
 */

$this->title = Yii::t('app.c2', 'My Poster');
$css = '
';
$this->registerCSS($css);
?>

<div class="container-fluid">
    <img style="width: 100%;margin: 10px 0" src="<?= $imgUrl ?>">

    <div class="alert alert-success" role="alert"><?= Yii::t('app.c2', 'Poster tips.') ?></div>
</div>


