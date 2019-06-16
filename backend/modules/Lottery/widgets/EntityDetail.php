<?php

namespace backend\modules\Lottery\widgets;

use Yii;
use cza\base\widgets\ui\common\part\EntityDetail as DetailWidget;

/**
 * Entity Detail Widget
 *
 * @author Ben Bi <ben@cciza.com>
 * @link http://www.cciza.com/
 * @copyright 2014-2016 CCIZA Software LLC
 * @license
 */
class EntityDetail extends DetailWidget
{
    public $withTranslationTabs = false;

    public $withProfileTab = false;

    public $withPrizeTab = false;

    public function getTabItems() {
        $items = [];
        if ($this->withPrizeTab) {
            $items[] = $this->getPrizeTab();
        }
        if ($this->withBaseInfoTab) {
            $items[] = [
                'label' => Yii::t('app.c2', 'Base Information'),
                'content' => $this->controller->renderPartial('_form', ['model' => $this->model,]),
                'active' => true,
            ];
        }
        $items[] = [
            'label' => '<i class="fa fa-th"></i> ' . $this->tabTitle,
            'onlyLabel' => true,
            'headerOptions' => [
                'class' => 'pull-left header',
            ],
        ];
        return $items;
    }

    public function getPrizeTab() {
        if (!isset($this->_tabs['PRIZE_TAB'])) {
            if (!$this->model->isNewRecord) {
                $this->_tabs['PRIZE_TAB'] = [
                    'label' => Yii::t('app.c2', 'Lottery Prize'),
                    'content' => $this->controller->renderPartial('/default/_prize', ['model' => $this->model]),
                    'enable' => true,
                ];
            } else {
                $this->_tabs['PRIZE_TAB'] = [
                    'label' => Yii::t('app.c2', 'Lottery Prize'),
                    'content' => "",
                    'enable' => false,
                ];
            }
        }

        return $this->_tabs['PRIZE_TAB'];
    }

}