<?php


?>


<div class="container-fluid">

    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        // 'options' => ['class' => 'box'],
        // 'itemOptions' => ['class' => 'box-item'],
        'itemView' => '_apply_item',
        'summary' => '',
        // 'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
        'pager' => [
            //'options' => ['class' => 'hidden'],//关闭分页（默认开启）
            'maxButtonCount' => 6,//最多显示几个分页按钮
            // 'firstPageLabel' => '首页',
            'prevPageLabel' => Yii::t('app.c2', 'Last Page'),
            'nextPageLabel' => Yii::t('app.c2', 'Next Page'),
            // 'lastPageLabel' => '尾页'
        ]
    ]);

    ?>
</div>