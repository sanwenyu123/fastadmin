<?php

// 第三方登录配置
return [
    // 微博配置
    // 申请请到http://open.weibo.com
    'weibo'  => [
        'app_id'     => '',
        'app_secret' => '',
        'callback'   => '',
    ],
    // 微信
    // 申请请到https://open.weixin.qq.com
    'wechat' => [
        'app_id'     => 'wx18822c4e74563cf1',
        'app_secret' => 'd8b3f80075f77b059695751af4bea6dc',
        'callback'   => 'http://fastadmin.net/index/user/callback',
        'scope'      => 'snsapi_base',
    ],
    // QQ
    // 申请请到https://connect.qq.com
    'qq'     => [
        'app_id'     => '',
        'app_secret' => '',
        'scope'      => 'get_user_info',
        'callback'   => '',
    ],
];
