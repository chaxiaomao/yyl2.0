<?php

use cza\base\widgets\ui\common\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use cza\base\models\statics\EntityModelStatus;
use cza\base\models\statics\OperationEvent;

/* @var $this yii\web\View */
/* @var $searchModel common\models\c2\search\FeUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app.c2', 'Fe User Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="well fe-user-model-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'pjax' => true,
        'hover' => true,
        'showPageSummary' => true,
        'panel' => ['type' => GridView::TYPE_PRIMARY, 'heading' => Yii::t('app.c2', 'Items')],
        'toolbar' => [
            [
                'content' =>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['edit'], [
                        'class' => 'btn btn-success',
                        'title' => Yii::t('app.c2', 'Add'),
                        'data-pjax' => '0',
                    ]) . ' ' .
                    // Html::button('<i class="glyphicon glyphicon-remove"></i>', [
                    //     'class' => 'btn btn-danger',
                    //     'title' => Yii::t('app.c2', 'Delete Selected Items'),
                    //     'onClick' => "jQuery(this).trigger('" . OperationEvent::DELETE_BY_IDS . "', {url:'" . Url::toRoute('multiple-delete') . "'});",
                    // ]) . ' ' .
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', Url::current(), [
                        'class' => 'btn btn-default',
                        'title' => Yii::t('app.c2', 'Reset Grid')
                    ]),
            ],
            '{export}',
            '{toggleData}',
        ],
        'exportConfig' => [],
        'columns' => [
            // ['class' => 'kartik\grid\CheckboxColumn'],
            // ['class' => 'kartik\grid\SerialColumn'],
            // [
            //     'class' => 'kartik\grid\ExpandRowColumn',
            //     'expandIcon' => '<span class="fa fa-plus-square-o"></span>',
            //     'collapseIcon' => '<span class="fa fa-minus-square-o"></span>',
            //     'detailUrl' => Url::toRoute(['detail']),
            //     'value' => function ($model, $key, $index, $column) {
            //         return GridView::ROW_COLLAPSED;
            //     },
            // ],
            'id',
            // 'type',
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    return \common\models\c2\statics\FeUserType::getLabel($model->type);
                }
            ],
            // 'attributeset_id',
            'score',
            'username',
            // 'email:email',
            // 'password_hash',
            // 'auth_key',
            // 'confirmed_at',
            // 'unconfirmed_email:email',
            // 'blocked_at',
            'registration_ip',
            // 'registration_src_type',
            [
                'attribute' => 'registration_src_type',
                'value' => function ($model) {
                    return \common\models\c2\statics\RegistrationSrcType::getLabel($model->registration_src_type);
                }
            ],
            // 'flags',
            // 'level',
            // 'last_login_at',
            'last_login_ip',
            // 'open_id',
            // 'wechat_union_id',
            // 'wechat_open_id',
            'mobile_number',
            // 'sms_receipt',
            // 'access_token',
            // 'password_reset_token',
            // 'district_id',
            // 'province_id',
            // 'city_id',
            // 'created_by',
            // 'updated_by',
            // 'status',
            // 'position',
            // 'created_at',
            // 'updated_at',
            [
                'attribute' => 'status',
                'class' => '\kartik\grid\EditableColumn',
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'formOptions' => ['action' => Url::toRoute('editColumn')],
                    'data' => EntityModelStatus::getHashMap('id', 'label'),
                    'displayValueConfig' => EntityModelStatus::getHashMap('id', 'label'),
                ],
                'filter' => EntityModelStatus::getHashMap('id', 'label'),
                'value' => function ($model) {
                    return $model->getStatusLabel();
                }
            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['edit', 'id' => $model->id], [
                            'title' => Yii::t('app', 'Info'),
                            'data-pjax' => '0',
                        ]);
                    }
                ]
            ],

        ],
    ]); ?>

</div>
