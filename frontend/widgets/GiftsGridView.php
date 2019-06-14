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
    public $playerId;

    public $template = '<div class="col-xs-4" style="padding: 0">
                            <div class="gift-item">
                                <div class="gift-photo">
                                    <span class="label label-success">{obtain_score}</span>
                                    <img style="width: 60px" align="center" src="{photo}">
                                </div>
                                <p>{title}</p>
                                <button data-value="{gift_id}" data-score="{gift_score}" class="btn btn-sm btn-success gift" style="width: 80%;line-height: 1;">{price}</button>
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
                        '{obtain_score}' => '+' . ($models[$j]->obtain_score + 0) . '积分',
                        '{photo}' => $models[$j]->getThumbnailUrl(),
                        '{title}' => $models[$j]->name . ' +' . $models[$j]->obtain_vote_number . '票',
                        '{price}' => '￥' . $models[$j]->price,
                        '{gift_id}' => $models[$j]->id,
                        '{gift_score}' => $models[$j]->obtain_score + 0,
                    ]);
                }

            }
            $result .= '</div>';
        }
        echo $result;

        // return $this->render('GiftsGridView', [
        // ]);
    }

    public function afterRun($result)
    {
        $view = $this->getView();
        $js = "";
        $js .= "
                $('.gift').on('click', function (e) {
                    var gift_id = jQuery(e.currentTarget).attr('data-value');
                    $.ajax({
                        type: 'post',
                        url: '/wechat/default/payment',
                        dataType: 'json',
                        data: {player_id:'{$this->playerId}', gift_id: gift_id},
                        beforeSend: function() {
                            window.top.window.showLoading();
                        },
                        success: function(data) {
                            console.log(data);
                            if(data._data == false) {
                                $('#content-modal').find('.modal-title').html('提示');
                                $('#content-modal').modal('show').find('.modal-body').html(data._meta.message);
                            }
                             if (data) {
                                var config = JSON.parse(data);
                                WeixinJSBridge.invoke('getBrandWCPayRequest', config, function (res) {
                                        if (res.err_msg == 'get_brand_wcpay_request:ok') {
                                            // 使用以上方式判断前端返回,微信团队郑重提示：
                                            // res.err_msg将在用户支付成功后返回
                                            // ok，但并不保证它绝对可靠。
                                            // var elem = $('#total-vote-number');
                                            // var gift_score = jQuery(e.currentTarget).attr('data-score');
                                            // elem.html(parseInt(elem.text()) + parseInt(gift_score));
                                            $('#content-modal').find('.modal-title').html('提示');
                                            $('#content-modal').modal('show').find('.modal-body').html('赠送成功');
                                            setTimeout(function(){location.reload()}, 2000);
                                        }
                                    }
                                )
                            }
                        },
                        error: function(res) {
                            if (res.status === 500) {
                                $('#content-modal').find('.modal-title').html('提示');
                                // $('#content-modal').modal('show').find('.modal-body').html(res.responseText);
                                $('#content-modal').modal('show').find('.modal-body').html('服务器开小差');
                            }
                        },
                        complete: function() {
                            window.top.window.hideLoading();
                        }
                    });
                })
                ";
        $view->registerJs($js);
        return parent::afterRun($result); // TODO: Change the autogenerated stub
    }

}