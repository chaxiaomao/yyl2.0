<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/9 0009
 * Time: 下午 16:01
 */

return [
    'q/<seo_code:.*>' => 'site/index',
    'player/<player_code:.*>' => 'player/default/index',
    'players' => 'player/default/players',
    'poster/<p:.*>' => 'player/default/poster',
    'apply/<seo_code:.*>' => 'apply/default/index',
    'lottery/q/<seo_code:.*>' => 'lottery/default/index',
];