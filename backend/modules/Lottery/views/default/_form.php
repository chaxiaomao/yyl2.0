<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use cza\base\widgets\ui\adminlte2\InfoBox;
use cza\base\models\statics\EntityModelStatus;

$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();
?>

<?php
$form = ActiveForm::begin([
    'action' => ['edit', 'id' => $model->id],
    'options' => [
        'id' => $model->getBaseFormName(),
        'data-pjax' => true,
    ]]);
?>

<div class="<?= $model->getPrefixName('form') ?>
">
    <?php if (Yii::$app->session->hasFlash($messageName)): ?>
        <?php if (!$model->hasErrors()) {
            echo InfoBox::widget([
                'withWrapper' => false,
                'messages' => Yii::$app->session->getFlash($messageName),
            ]);
        } else {
            echo InfoBox::widget([
                'defaultMessageType' => InfoBox::TYPE_WARNING,
                'messages' => Yii::$app->session->getFlash($messageName),
            ]);
        }
        ?>
    <?php endif; ?>

    <div class="well">
        <?php
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 2,
            'attributes' => [
                'type' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => []],
                'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('name')]],
                'label' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('label')]],
                'activity_id' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => \common\models\c2\entity\ActivityModel::getAllActivities(), 'options' => ['placeholder' => $model->getAttributeLabel('activity_id')]],
                'need_score' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('need_score')]],
                // 'content' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\vova07\imperavi\Widget', 'options' => [
                //     'settings' => [
                //         'minHeight' => 150,
                //         'buttonSource' => true,
                //         'lang' => $regularLangName,
                //         'plugins' => [
                //             'fontsize',
                //             'fontfamily',
                //             'fontcolor',
                //             'table',
                //             'textdirection',
                //             'fullscreen',
                //         ],
                //     ]
                // ],],
                'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
            ]
        ]);

        $multipleItemsId = $model->getPrefixName('items');
        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 1,
            'attributes' => [
                'items' => [
                    'type' => Form::INPUT_WIDGET,
                    'label' => Yii::t('app.c2', 'Add Lottery Prize Items'),
                    'widgetClass' => unclead\multipleinput\MultipleInput::className(),
                    'options' => [
                        'id' => $multipleItemsId,
                        'data' => $model->items,
                        //  'max' => 4,
                        'allowEmptyList' => true,
                        'rowOptions' => function ($model, $index, $context) use ($multipleItemsId) {
                            return ['id' => "row{multiple_index_{$multipleItemsId}}", 'data-id' => $model['id']];
                        },
                        'columns' => [
                            [
                                'name' => 'id',
                                'type' => 'hiddenInput',
                            ],
                            [
                                'name' => 'prize_id',
                                'type' => 'dropDownList',
                                'title' => Yii::t('app.c2', 'Lottery Prize'),
                                'items' => \common\models\c2\entity\LotteryPrizeModel::getHashMap('id', 'name', ['status' => EntityModelStatus::STATUS_ACTIVE]),
                            ],
                            [
                                'name' => 'chance',
                                'title' => Yii::t('app.c2', 'Chance'),
                                'options' => [
                                    // 'type' => 'number',
                                    // '' => '0.00',
                                ]
                            ],
                            // [
                            //     'name' => 'position',
                            //     'title' => Yii::t('app.c2', 'Position'),
                            //     'type' => '',
                            //     'options' => [
                            //         'type' => 'number',
                            //     ]
                            // ],
                            [
                                'name' => 'position',
                                'type' => kartik\widgets\TouchSpin::className(),
                                'title' => Yii::t('app.c2', 'Position'),
                                'defaultValue' => 0,
                                'options' => [
                                    'pluginOptions' => [
                                        'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
                                        'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>',
                                    ],
                                ]
                            ],
                        ]
                    ],
                ],
            ]
        ]);

        echo Form::widget([
            'model' => $model,
            'form' => $form,
            //            'columns' => 2,
            'attributes' => [
                'content' => ['type' => Form::INPUT_WIDGET,
                    'widgetClass' => 'common\widgets\ueditor\Ueditor',
                    'options' => [
                        // 'class' => 'col-sm-6 pull-left',
                    ],
                ],
            ],
        ]);

        echo Html::beginTag('div', ['class' => 'box-footer']);
        echo Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app.c2', 'Save'), ['type' => 'button', 'class' => 'btn btn-primary pull-right']);
        echo Html::a('<i class="fa fa-arrow-left"></i> ' . Yii::t('app.c2', 'Go Back'), ['index'], ['data-pjax' => '0', 'class' => 'btn btn-default pull-right', 'title' => Yii::t('app.c2', 'Go Back'),]);
        echo Html::endTag('div');
        ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
