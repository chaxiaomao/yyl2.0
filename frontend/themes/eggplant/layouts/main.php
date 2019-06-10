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
\frontend\themes\eggplant\Eggplant::register($this);

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
    <meta name="screen-orientation"content="portrait">
    <!--QQ浏览器禁止横屏-->
    <meta name="x5-orientation" content="portrait">
    <meta http-equiv="pragma" content="no-cache" />
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
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

