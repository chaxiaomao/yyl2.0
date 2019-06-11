<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/11
 * Time: 22:06
 */

namespace frontend\widgets;


use common\models\c2\entity\ActivityModel;
use yii\base\Widget;

class GiftsGridView extends Widget
{
    /**
     * @var ActivityModel
     */
    public $activityModel;

    public $template = '<div class="col-xs-4" style="padding: 0">
                            <div class="gift-item">
                                <div class="gift-photo">
                                    <span class="label label-success">{score}</span>
                                    <img style="width: 60px" align="center" src="{photo}">
                                </div>
                                <p>{title}</p>
                                <button class="btn btn-sm btn-success" style="width: 80%">赠送</button>
                            </div>
                        </div>';

    public function run()
    {
        $models = $this->activityModel->getActivityGifts();
        $rows = count($models) / 3;
        // $remain = count($models) % 3;
        $result = "";
        for ($i = 0; $i < $rows; $i++) {
            $result .= '<div class="row" style="margin: 0">';
            for ($j = $i * 3; $j < ($i + 1) * 3; $j++) {
                if (!is_null($models[$j])) {
                    $result .= strtr($this->template, [
                        '{score}' => '+' . ($models[$j]->obtain_score + 0) . '积分',
                        '{photo}' => $models[$j]->getThumbnailUrl(),
                        '{title}' => $models[$j]->name . $models[$j]->obtain_vote_number,
                    ]);
                }

            }
            $result .= '</div>';
        }
        \Yii::info($result);
        echo $result;

        // return $this->render('GiftsGridView', [
        // ]);
    }

}