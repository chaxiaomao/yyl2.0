<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use cza\base\widgets\ui\adminlte2\InfoBox;
use cza\base\models\statics\EntityModelStatus;
use yii\widgets\Pjax;

$this->title = $activityModel->title;
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
    .redactor-editor {
        padding: 10px;
    }

    .btn-file {
        width: 100%;
        background-color: #ffe45c
    }

    .field-activityapplyform-avatar .btn-primary {
        border-color: #f0ad4e;
    }

    .field-activityapplyform-avatar .btn-primary:active {
        background-color: #f0ad4e;
        border-color: #ffe45c
    }

    .file-preview {
        background-color: #ffffff
    }

    label {
        color: #ffffff
    }
</style>

<?php
\yii\bootstrap\Modal::begin([
    'id' => 'content-modal',
    'header' => '<p class="modal-title"></p>',
]);
\yii\bootstrap\Modal::end();

?>

<?= \frontend\widgets\PhotosSwiper::widget(['model' => $activityModel]) ?>
<p></p>

<?php Pjax::begin(['id' => $model->getDetailPjaxName(), 'formSelector' => $model->getBaseFormName(true), 'enablePushState' => false, 'clientOptions' => [
    'skipOuterContainers' => true
]]) ?>

<?php
$form = ActiveForm::begin([
    'action' => ['index', 's' => $activityModel->seo_code],
    'options' => [
        'id' => $model->getBaseFormName(),
        'data-pjax' => true,
    ]]);
?>

<div class="<?= $model->getPrefixName('form') ?>">


    <div class="container-fluid">

        <?php if (Yii::$app->session->hasFlash($messageName)): ?>
            <?php
            $js = "$('#content-modal').find('.modal-title').html('提示');
                $('#content-modal').modal('show').find('.modal-body').html('" . Yii::$app->session->getFlash($messageName)[0] . "');";
            $this->registerJs($js);
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
                            'defaultPreviewContent' => '<img src="/images/common/default_img.png" alt="" style="width:60%">',
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
                    'options' => [
                        'value' => Yii::$app->user->id
                    ]
                ],
                'activity_id' => [
                    'type' => Form::INPUT_HIDDEN,
                    'options' => [
                        'value' => $activityModel->id
                    ]
                ],
                // 'income' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('income')]],
                // 'player_code' => [
                //     'type' => Form::INPUT_TEXT,
                //     'options' => [
                //         'placeholder' => $model->getAttributeLabel('player_code'),
                //         'readonly' => true,
                //     ]
                // ],
                'label' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => $model->getAttributeLabel('label')]],
                'title' => [
                    'type' => Form::INPUT_TEXT,
                    'options' => [
                        'placeholder' => Yii::t('app.c2', 'Title like that.')
                    ]
                ],
                'content' => [
                    'type' => Form::INPUT_WIDGET,
                    'widgetClass' => '\vova07\imperavi\Widget',
                    'options' => [
                        'settings' => [
                            'placeholder' => Yii::t('app.c2', 'Content like that.')
                        ]
                    ]
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
                'type' => [
                    'type' => Form::INPUT_HIDDEN,
                    'options' => [
                        'value' => \common\models\c2\statics\ActivityPlayerType::TYPE_USER_ENTRY,
                    ]
                ]
            ]
        ]);

        echo Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('app.c2', 'Submit Application'), [
            'type' => 'button', 'class' => 'btn btn-warning btn-block'
        ]);
        ?>

        <div class="content" style="color: #ffffff">

            <h4 style="text-align: center;font-weight: bold"><?= Yii::t('app.c2', 'Activity Introduce') ?></h4>
            <?= $activityModel->content ?>
        </div>

    </div>

</div>
<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>
