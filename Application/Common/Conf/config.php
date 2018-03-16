<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'               =>  'mysql',          // 数据库类型
    'DB_HOST'               =>  '121.43.165.149', // 服务器地址
    'DB_NAME'               =>  'mallplatform',   // 数据库名
    'DB_USER'               =>  'root',           // 用户名
    'DB_PWD'                =>  'Buyun666888!',   // 密码
    'DB_PORT'               =>  '3306',           // 端口
    'DB_PREFIX'				=>	'mall_',		  // 表前缀
    //配置文件上传路径
    '__PATH_ROOT__'   => '/bweb/azshop/',                       // 接口根目录
    '__PATH_UPLOAD__' => 'Public/',  // 文件上传目录
    '__PATH_IMAGE__'  => 'Public/image/',         // 图片路径
    '__PATH_TUIHUAN__'=> 'Public/image/tuihuan/', // 退换货，售后
    '__PATH_PHOTO__'  => 'Public/image/photo/',   // 相册目录，上线后加深一个层级
    '__PATH_VIDEO__'  => 'Public/video/',         // 视频和视频缩略图资源
    '__PATH_HEADER__' => 'Public/header/',        // 用户头像像资源
    '__PATH_COMMENT__' => 'Public/comment/',        // 商品评论图片
    'url_model' => 1,
    //分享功能配置
    'EWM_PATH'        => 'Public/Uploads/image/erweima/',    // 分享二维码存放路径
    'EWM_URL'         => 'http://www.xuanwb.com/register/0', // 分享二维码跳转地址

    //缩略图控制
    '__HEADER_W__'   => 150,          // 设置用户头像宽度
    '__HEADER_H___'   => 150,          // 设置用户头像高度


    //配置每页显示的数据条数
    '__PAGESIZE__' => 10,


    //需要登陆验证的接口
    'CHECKLIST' => [
        'Mobile/Myinfo/*',  //获取个人信息都需要验证登陆
        'Computer/Shop/comment',  //评论管理
        'Computer/Shop/commentadd',  //评论管理
        'Computer/Shop/commentremove',  //评论管理
    ],

    //设置登陆过期时长
    'LandExpirationTime'=>[
        'number'=>'1',
        'nuit'=>'month',
    ],

    //允许访问的接口的域名
    'HTTP_ORIGIN' => '127.0.0.1',

    /* 数据缓存设置 */
    'DATA_CACHE_TIME' =>  604800,      // 设置数据缓存有效期为 7天

    '__NAMESPACE__'   => ['Common','Mobile'],          //模块列表

    //设置管理员
    'Administrators' => [
        '吴伟锋' => 'wvfeng@live.com',
        '陈冲'   => '2379920898@qq.com',
        '赵辉'   => '805492074@qq.com',
        '明明'   => '1025812312@qq.com',
    ],

    //验证码配置
    'SECURITY_CODE'=>[
        'MAX_TIME'=> 60 * 15,//十五分钟之内有效
        'MIN_TIME'=> 60,   //将允许重新获取的时间
    ],

    //Redis配置
    'REDIS_HOST'=>'127.0.0.1',

    //验证码配置
    'SECURITY_CODE'=>[
        'MAX_TIME'=> 60 * 15,//十五分钟之内有效
        'MIN_TIME'=> 60,   //将允许重新获取的时间
    ],

    //邮箱配置
    'EMAIL'=>'YTo4OntzOjg6IlNNVFBBdXRoIjtiOjE7czo0OiJIb3N0IjtzOjEyOiJzbXRwLjE2My5jb20iO3M6ODoiVXNlcm5hbWUiO3M6Njoid3ZmZW5nIjtzOjg6IlBhc3N3b3JkIjtzOjEwOiJwaHBtYWlsMTYzIjtzOjY6IklzSFRNTCI7YjoxO3M6NzoiQ2hhclNldCI7czo1OiJVVEYtOCI7czo0OiJGcm9tIjtzOjE0OiJ3dmZlbmdAMTYzLmNvbSI7czo4OiJGcm9tTmFtZSI7czo2OiJ3dmZlbmciO30',

    //短信接口配置
    'SMS'   => 'YTo0OntzOjExOiJhY2Nlc3NLZXlJZCI7czoxNjoiTFRBSUpYZWNGTGpnNWNjeCI7czoxNToiYWNjZXNzS2V5U2VjcmV0IjtzOjMwOiIxcmd2eTVBY3k1Sk1QOU1pMHNmMUhQcTBHRFk5SVoiO3M6ODoic2lnbk5hbWUiO3M6MTg6IuatpeS6keS/oeaBr+aKgOacryI7czoxMjoidGVtcGxhdGVDb2RlIjtzOjEzOiJTTVNfMTI0NzMwMDcyIjt9',

    //paypal 国外支付
    'PAY_PAL'=>[
        'Client_ID' => 'AVxNWX6-Ps4IZZg6foezeIH2CykIsmokTUWKtNqjzT6auAQc4diM9QDIbDUiPuqkKy98Z6rz9XXEJte7',
        'Secret' => 'ECEbhhV12ZmAPoXPpkSoRA7s5xOSrSouhqFMasWK34EdfZgQ0U6XrIWN7Uwv8iUU8s4Qo4jUllRl1PkP',
        'Account'=>'account@brandingrewards.com.au', // 正式账号
        'AccountTest'=>'account-facilitator@Brandingrewards.com.au' // 测试账号
    ]

    );