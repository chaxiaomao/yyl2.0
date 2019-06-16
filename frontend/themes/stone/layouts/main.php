<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/9 0009
 * Time: 下午 16:10
 */

?>

<?php
/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;

\frontend\themes\stone\Stone::register($this);

if (Yii::$app->wechat->isWechat) {
    $this->render("partials/_wechat_js");
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="initial-scale=1, maximum-scale=3, minimum-scale=1, user-scalable=no">
    <!--UC浏览器禁止横屏-->
    <meta name="screen-orientation" content="portrait">
    <!--QQ浏览器禁止横屏-->
    <meta name="x5-orientation" content="portrait">
    <meta http-equiv="pragma" content="no-cache"/>
    <?= Html::csrfMetaTags() ?>
    <?php
    // if ($this->beginCache('baidu_statiistic', ['duration' => Yii::$app->settings->get('perf\cache_duration', 3600), 'enabled' => Yii::$app->settings->get('perf\cache_enable', 1)])) {
    //     echo \app_eshop\widgets\Common\Baidu\StatisticWidget::widget([]);
    //
    //     $this->endCache();
    // }
    ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<style>
    html {
        height: 100%;
    }

    body {
        /*background-color: #eeeeee;*/
        /*background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);*/
        margin-bottom: 60px;
        background: linear-gradient(to top, #0ba360 0%, #3cba92 100%) fixed;
    }

    .bottom {
        width: 100%;
        position: fixed;
        z-index: 99;
        bottom: 0;
        left: 0;
        text-align: center;
        background-color: #ffffff;
    }

    .bottom a {
        height: 42px;
        line-height: 42px;
        color: green;
    }
</style>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<div class="container-fluid bottom">
    <div class="row">
        <?= Html::a('<span class="glyphicon glyphicon-stats">' . Yii::t('app.c2', 'Rank') . '</span>', '/q/'. $this->context->activity->seo_code, ['class' => 'col-xs-3']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-gift">' . Yii::t('app.c2', 'Lottery') . '</span>', '/lottery/q/'. $this->context->activity->seo_code, ['class' => 'col-xs-3']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-phone">' . Yii::t('app.c2', 'Apply') . '</span>', '/apply/'. $this->context->activity->seo_code, ['class' => 'col-xs-3']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-user">' . Yii::t('app.c2', 'Mine') . '</span>', '/q/'. $this->context->activity->seo_code, ['class' => 'col-xs-3']) ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

