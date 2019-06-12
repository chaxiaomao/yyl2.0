<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use cza\base\widgets\ui\adminlte2\InfoBox;
use cza\base\models\statics\EntityModelStatus;
use yii\widgets\Pjax;

$regularLangName = \Yii::$app->czaHelper->getRegularLangName();
$messageName = $model->getMessageName();

$css = '
[contenteditable="true"], input, textarea {
    -webkit-user-select: auto!important;
    -khtml-user-select: auto!important;
    -moz-user-select: auto!important;
    -ms-user-select: auto!important;
    -o-user-select: auto!important;
    user-select: auto!important;
}
';
$this->registerCSS($css);

?>
<style>
    .redactor-editor {padding: 10px;}
    .btn-file {width: 100%;background-color: #ffe45c}
    .field-activityapplyform-avatar .btn-primary {border-color: #f0ad4e;}
    .field-activityapplyform-avatar .btn-primary:active {background-color: #f0ad4e;border-color: #ffe45c}
    .file-preview {background-color: #ffffff}
    label {color: #ffffff}
</style>

<?php Pjax::begin(['id' => $model->getDetailPjaxName(), 'formSelector' => $model->getBaseFormName(true), 'enablePushState' => false, 'clientOptions' => [
    'skipOuterContainers' => true
]]) ?>
<?php
$form = ActiveForm::begin([
    'action' => ['index', 's' => $model->activityCode],
    'options' => [
        'id' => $model->getBaseFormName(),
        'data-pjax' => true,
    ]]);
?>

    <div class="<?= $model->getPrefixName('form') ?>">


        <div class="container-fluid">

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

            <?php

            echo \kartik\builder\Form::widget([
                'model' => $model,
                'form' => $form,
                'columns' => 1,
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
                                'defaultPreviewContent' => '<img src="/images/common/default_img.png" alt="' . Yii::t('app.c2', '{s1} avatar', ['s1' => Yii::t('app.c2', 'Photo')]) . '" style="width:100%">',
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
                'columns' => 1,
                'attributes' => [
                    // 'type' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => \common\models\c2\statics\ActivityEntryType::getHashMap('id', 'label')],
                    // 'user_id' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('user_id')]],
                    'user_id' => [
                        'type' => Form::INPUT_HIDDEN,

                    ],
                    'activity_id' => [
                        'type' => Form::INPUT_HIDDEN,
                    ],
                    // 'income' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('income')]],
                    // 'player_code' => [
                    //     'type' => Form::INPUT_TEXT,
                    //     'options' => [
                    //         'placeholder' => $model->getAttributeLabel('player_code'),
                    //         'readonly' => true,
                    //     ]
                    // ],
                    'title' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('title')]],
                    // 'label' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('label')]],
                    'content' => [
                        'type' => Form::INPUT_WIDGET,
                        'widgetClass' => '\vova07\imperavi\Widget',
                    ],
                    // 'mobile_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('mobile_number')]],
                    // 'free_vote_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('free_vote_number')]],
                    // 'gift_vote_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('gift_vote_number')]],
                    // 'total_vote_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('total_vote_number')]],
                    // 'share_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('share_number')]],
                    // 'view_number' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('view_number')]],
                    // 'state' => ['type' => Form::INPUT_WIDGET, 'widgetClass' => '\kartik\checkbox\CheckboxX', 'options' => [
                    //     'pluginOptions' => ['threeState' => false],
                    // ],],
                    // 'state' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => \common\models\c2\statics\ActivityPlayerState::getHashMap('id', 'label')],
                    // 'status' => ['type' => Form::INPUT_DROPDOWN_LIST, 'items' => EntityModelStatus::getHashMap('id', 'label')],
                ]
            ]);

            echo Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app.c2', 'Save'), [
                    'type' => 'button', 'class' => 'btn btn-warning btn-block'
            ]);
            ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>