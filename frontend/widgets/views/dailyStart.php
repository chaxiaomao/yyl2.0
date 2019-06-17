<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/17
 * Time: 22:25
 */
?>
<style>
    .modal-body {
        position: relative;
        padding: 0;
    }

    .player-header {
        width: 22%;
        position: absolute;
        top: 0;
        bottom: -60px;
        left: 0;
        right: 0;
        margin: auto;
    }

    @media screen and (min-width: 400px) {
        .player-header {
            width: 80px;
            position: absolute;
            top: 0;
            bottom: -50px;
            left: 0;
            right: 0;
            margin: auto;
        }
    }

    @media screen and (min-width: 500px) {
        .player-header {
            width: 120px;
            position: absolute;
            top: 0;
            bottom: -80px;
            left: 0;
            right: 0;
            margin: auto;
        }
    }

</style>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <!--                <h4 class="modal-title">Modal 标题</h4>-->
            </div>
            <div class="modal-body">
                <img style="width: 100%" src="/images/60.jpg"/>
                <img class="player-header" src="<?= $model->getThumbnailUrl() ?>"/>
            </div>
            <!--            <div class="modal-footer">-->
            <!--                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>-->
            <!--                <button type="button" class="btn btn-primary">确定</button>-->
            <!--            </div>-->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    $(function () {
        // dom加载完毕
        var $modal = $('#myModal');

        // 测试 bootstrap 居中
        $modal.on('show.bs.modal', function () {
            var $this = $(this);
            var $modal_dialog = $this.find('.modal-dialog');
            // 关键代码，如没将modal设置为 block，则$modala_dialog.height() 为零
            $this.css('display', 'block');
            $modal_dialog.css({'margin-top': Math.max(0, ($(window).height() - $modal_dialog.height()) / 2)});
        });

        $modal.modal({backdrop: 'static'});

    });
</script>