<?php
use yii\helpers\Html;
use cza\base\widgets\ui\adminlte2\Box;
use cza\base\widgets\ui\common\form\Tabs;

Box::begin([
    'options' => ['id' => $this->context->model->getPrefixName('box')],
    'config' => [
        'header' => [ 'tools' => '{collapse}',],
    ]
]);

echo Html::beginTag('div', [ "class" => "nav-tabs-custom"]);
echo Tabs::widget([
    'id' => $this->context->getTabsId(),
    'position' => Tabs::POS_ABOVE,
    'bordered' => false,
    'encodeLabels' => false,
    'align' => Tabs::ALIGN_LEFT,
    'items' => $this->context->getTabItems(),
    'options' => [
        'class' => 'nav nav-tabs pull-right',
    ],
]);

echo Html::endTag('div');
Box::end();
