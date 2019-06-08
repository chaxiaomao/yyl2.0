<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
// $directoryAsset = \Yii::$app->czaHelper->getEnvData('AdminlteAssets');
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="<?= Yii::t('app.c2', 'Search...') ?>"/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                                class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <?=
        cza\base\widgets\ui\common\menu\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu', "data-widget" => "tree"],
                'linkTemplate' => '<a href="{url}" {targetPlaceHolder}>{icon} {label}</a>',
                'items' => [
                    ['label' => Yii::t('app.c2', 'Menu'), 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app.c2', 'Dashboard'), 'icon' => 'fa fa-circle-o', 'url' => ['/']],
                    // ['label' => Yii::t('app.c2', 'Resume'), 'icon' => 'fa fa-circle-o', 'url' => ['/resume']],
                    [
                        'label' => Yii::t('app.c2', 'Database'), 'visible' => \Yii::$app->user->can('P_Logistics'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                        'items' => [
                            [
                                'label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Product')]), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                'items' => [
                                    ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Production')]), 'icon' => 'fa fa-circle-o', 'url' => ['/database/product/default/production']],
                                    ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Material')]), 'icon' => 'fa fa-circle-o', 'url' => ['/database/product/default/material']],
                                ]
                            ],
                            ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'User')]), 'icon' => 'fa fa-circle-o', 'url' => ['/database/users']],
                            // ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Attribute')]), 'icon' => 'fa fa-circle-o', 'url' => ['/database/attribute']],
                            // ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Attributeset')]), 'icon' => 'fa fa-circle-o', 'url' => ['/database/attributeset']],
                        ]
                    ],
                    [
                        'label' => Yii::t('app.c2', 'Purchase Sale Storage System'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                        'visible' => \Yii::$app->user->can('P_P3S'),
                        'items' => [
                            [
                                'label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Finance')]), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                'visible' => \Yii::$app->user->can('P_Finance'),
                                'items' => [
                                    ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Order')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/finance/order']],
                                    // ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'EsConsumption')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/es-consumption']],
                                    ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Inventory Receipt Notes')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/receipt-note']],
                                    ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Inventory Delivery Notes')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/delivery-note']],
                                ]
                            ],
                            [
                                'label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Warehouse')]), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                'visible' => \Yii::$app->user->can('P_Warehouse'),
                                'items' => [
                                    ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Product Stock')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/product-stock']],
                                    [
                                        'label' => Yii::t('app.c2', 'Untrack Notes'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                        'items' => [
                                            ['label' => Yii::t('app.c2', 'Inventory Receipt Notes'), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/untrack/receipt-note']],
                                            ['label' => Yii::t('app.c2', 'Inventory Delivery Notes'), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/untrack/delivery-note']],
                                        ],
                                    ],
                                ]
                            ],
                            // ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Finance')]), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'], 'items' => [
                            // ]],
                            ['label' => Yii::t('app.c2', 'Config'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                'items' => [
                                    ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Warehouse')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/config/warehouse/default']],
                                    ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Supplier')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/config/supplier']],
                                    ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Measure')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/config/measure']],
                                    ['label' => Yii::t('app.c2', '{s1} Management', ['s1' => Yii::t('app.c2', 'Currency')]), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/config/currency']],
                                ]
                            ],
                            ['label' => Yii::t('app.c2', 'Logs'), 'icon' => 'fa fa-circle-o', 'url' => ['/p3s/inventory/logs']],

                        ]
                    ],
                    [
                        'label' => Yii::t('app.c2', 'Logistics'), 'visible' => \Yii::$app->user->can('P_Logistics'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                        'items' => [
                            ['label' => Yii::t('app.c2', 'Region'), 'icon' => 'fa fa-circle-o', 'url' => ['/logistics/region']],
                        ]
                    ],
                    [
                        'label' => Yii::t('app.c2', 'System'), 'visible' => \Yii::$app->user->can('P_System'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                        'items' => [
                            ['label' => Yii::t('app.c2', 'Configuration'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                'items' => [
                                    // ['label' => Yii::t('app.c2', 'Merchant Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/crm/merchant'],],
                                    // ['label' => Yii::t('app.c2', 'Params Settings'), 'icon' => 'fa fa-circle-o', 'url' => ['/sys/config/default/params-settings']],
                                    ['label' => Yii::t('app.c2', 'Common Resource'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                        'items' => [
                                            ['label' => Yii::t('app.c2', 'Attachement Management'), 'icon' => 'fa fa-circle-o', 'url' => ['/sys/common-resource/attachment'],],
                                            ['label' => Yii::t('app.c2', 'Global Settings'), 'icon' => 'fa fa-circle-o', 'url' => ['/sys/config']],
                                        ]
                                    ],
                                    // ['label' => Yii::t('app.c2', 'Transfer Settings'), 'icon' => 'fa fa-circle-o', 'url' => ['/sys/config/default/transfer-settings']],
                                    // ['label' => Yii::t('app.c2', 'Api'), 'icon' => 'fa fa-circle-o', 'url' => ['/api']],
                                ]
                            ],
                            ['label' => Yii::t('app.c2', 'Security'), 'icon' => 'fa fa-circle-o', 'url' => ['#'], 'options' => ['class' => 'treeview'],
                                'items' => [
                                    ['label' => Yii::t('app.c2', 'Users & Rbac'), 'icon' => 'fa fa-circle-o', 'url' => ['/user/admin']],
                                ]
                            ],
                            //                            ['label' => Yii::t('app.c2', 'Task Manage'), 'icon' => 'fa fa-circle-o', 'url' => ['/task/cron']],
                        ]
                    ],
                    ['label' => Yii::t('app.c2', 'Sign out'), 'icon' => 'fa fa-sign-out', 'url' => ['/user/logout']],
                ],
            ]
        )
        ?>

    </section>

</aside>
