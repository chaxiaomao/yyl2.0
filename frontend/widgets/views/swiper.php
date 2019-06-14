<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/14
 * Time: 23:45
 */
?>


<!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php if ($model->getOriginalUrl() != ""): ?>
            <div class="swiper-slide"><img class="w100" src="<?= $model->getOriginalUrl() ?>"></div>
        <?php endif; ?>
        <?php foreach ($model->getPhotos() as $item): ?>
            <div class="swiper-slide"><img class="w100" src="<?= $item ?>"></div>
        <?php endforeach; ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>