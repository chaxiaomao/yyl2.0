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

        echo \kartik\builder\Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 2,
            'attributes' => [
                'avatar' => [
                    'label' => Yii::t('app.c2', 'Photo Add'),
                    'type' => \kartik\builder\Form::INPUT_WIDGET,
                    'widgetClass' => '\kartik\widgets\FileInput',
                    'options' => [
                        'options' => [
                            'accept' => 'image/*',
                        ],
                        'pluginOptions' => [
                            'overwriteInitial' => true,
                            'maxFileSize' => 2000,
                            'showClose' => false,
                            'showCaption' => false,
                            'browseLabel' => '',
                            'removeLabel' => '',
                            'browseIcon' => '<i class="glyphicon glyphicon-folder-open"></i>',
                            'removeIcon' => '<i class="glyphicon glyphicon-remove"></i>',
                            'removeTitle' => 'Cancel or reset changes',
                            'elErrorContainer' => '#kv-avatar-errors-1',
                            'msgErrorClass' => 'alert alert-block alert-danger',
                            'defaultPreviewContent' => '<img src="/images/common/default_img.png" alt="' . Yii::t('app.c2', '{s1} avatar', ['s1' => Yii::t('app.c2', 'Product')]) . '" style="width:160px">',
                            'layoutTemplates' => "{main2: '{preview} {browse} {remove}'}",
                            'allowedFileExtensions' => ["jpg", "png", "gif", 'jpeg'],
                            'showUpload' => false,
                            'initialPreview' => $model->getInitialPreview('avatar', \cza\base\models\statics\ImageSize::ORGINAL),
                            'initialPreviewConfig' => $model->getInitialPreview('avatar'),
                        ],
                    ],
                ],
            ]
        ]);

        echo Form::widget([
            'model' => $model,
            'form' => $form,
            'columns' => 2,
            'attributes' => [
                'type' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => \common\models\c2\statics\ActivityPlayerType::getHashMap('id', 'label')],
                // 'user_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('user_id')]],
                'user_id' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => '\kartik\widgets\Select2',
                    'options' => [
                        'language' => Yii::$app->language,
                        'initValueText' => $model->isNewRecord ? "" : $model->user->username,
                        'options' => [
                            'multiple' => false,
                            'placeholder' => Yii::t('app.c2', 'Search {s1}', ['s1' => Yii::t('app.c2', 'User')]),
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'minimumInputLength' => 1,
                            'ajax' => [
                                'url' => \yii\helpers\Url::toRoute('search-user'),
                                'dataType' => 'json',
                                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                            ],
                            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                            'templateResult' => new \yii\web\JsExpression('function(data) { return data.text; }'),
                            'templateSelection' => new \yii\web\JsExpression('function (data) { return data.text; }'),
                        ],
                    ],
                ],
                'activity_id' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => '\kartik\widgets\Select2',
                    'options' => [
                        'language' => Yii::$app->language,
                        'initValueText' => $model->isNewRecord ? "" : $model->activity->title,
                        'options' => [
                            'multiple' => false,
                            'placeholder' => Yii::t('app.c2', 'Search {s1}', ['s1' => Yii::t('app.c2', 'Activity')]),
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'minimumInputLength' => 1,
                            'ajax' => [
                                'url' => \yii\helpers\Url::toRoute('search-activity'),
                                'dataType' => 'json',
                                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                            ],
                            'escapeMarkup' => new \yii\web\JsExpression('function (markup) { return markup; }'),
                            'templateResult' => new \yii\web\JsExpression('function(data) { return data.text; }'),
                            'templateSelection' => new \yii\web\JsExpression('function (data) { return data.text; }'),
                        ],
                    ],
                ],
                'income' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('income')]],
                'player_code' => [
                    'type' => Form::INPUT_TEXT,
                    'options' => [
                        'placeholder' => $model->getAttributeLabel('player_code'),
                        'readonly' => true,
                    ]
                ],
                'title' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('title')]],
                // 'label' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('label')]],
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
                'mobile_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('mobile_number')]],
                'free_vote_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('free_vote_number')]],
                'gift_vote_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('gift_vote_number')]],
                'total_vote_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('total_vote_number')]],
                'share_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('share_number')]],
                'view_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('view_number')]],
                // 'state' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\checkbox\CheckboxX', 'options' => [
                //     'pluginOptions' => ['threeState' => false],
                // ],],
                'state' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => \common\models\c2\statics\ActivityPlayerState::getHashMap('id', 'label')],
                'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
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
