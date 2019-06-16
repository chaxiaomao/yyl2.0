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
    'poster/<p:.*>' => 'player/default/poster',
    'apply/<code:.*>' => 'apply/default/index',
    'lottery/q/<code:.*>' => 'lottery/default/index',
];