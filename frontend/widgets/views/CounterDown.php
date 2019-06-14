<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/11 0011
 * Time: 上午 9:34
 */

?>


<div id="dateShow2" class="white-bg" style="margin: 50px 0 10px 0">

    <img class="icon" src="/images/common/clock.png">
    <span id="dataInfoShow_2">活动已结束</span>
    <span class="date-tiem-span d">00</span>天
    <span class="date-tiem-span h">00</span>时
    <span class="date-tiem-span m">00</span>分
    <span class="date-s-span s">00</span>秒
</div>

<?php
$js = <<<JS
    var clearTime = 0;
    function setDateImportFn(){
        //清除时间
        window.clearInterval(clearTime);
        /*== 获取数据 ==*/
        var data2={};
        //开始时间
        data2.startdate='<?= $activityModel->start_at ?>';
        //结束时间
        data2.enddate='<?= $activityModel->end_at ?>';
        //是否跳过开始
        data2.init=true;
        clearTime2=$.leftTime(data2,function(d){
            if(d.status){
                var dateShow1=$("#dateShow2");
                dateShow1.find(".d").html(d.d);
                dateShow1.find(".h").html(d.h);
                dateShow1.find(".m").html(d.m);
                dateShow1.find(".s").html(d.s);
                switch(d.step){
                    case 1:
                    $("#dataInfoShow_2").html("距离开始时间");
                    break;
                    case 2:
                    $("#dataInfoShow_2").html("距活动结束时间");
                    break;
                    case 3:
                    $("#dataInfoShow_2").html("活动已结束");
                    break;
                    default: 
                    $("#dataInfoShow_2").html("");
                     break;
                }
            }
        }, true);
    }
//初始化
setDateImportFn();
JS;
$this->registerJS($js);
?>