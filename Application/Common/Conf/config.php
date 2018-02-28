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
        '/Mobile/Myinfo/*',  //
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

    '__NAMESPACE__'   => ['Mobile','Computer','Common'],          //模块列表

    //设置管理员
    'Administrators' => [
        '吴伟锋' => 'wvfeng@live.com',
        '陈冲'   => '2379920898@qq.com',
        '赵辉'   => '805492074@qq.com',
        '明明'   => '1025812312@qq.com',
    ],

    //短信接口配置
    'SMS'   => [
        'accessKeyId' => 'LTAIJXecFLjg5ccx',
        'accessKeySecret' => '1rgvy5Acy5JMP9Mi0sf1HPq0GDY9IZ',
        'signName' => '步云信息技术',
        'templateCode' => 'SMS_124730072'
    ],
);