<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="pragram" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>会员系统</title>
        <link href="/mallplatform/Public/Admin/css/style.css" rel="stylesheet" type="text/css">
        <link href="/mallplatform/Public/Admin/css/iconfont.css" rel="stylesheet" type="text/css">
        <script src="/mallplatform/Public/Admin/js/jquery-1.11.1.min.js"></script>
        <script src="/mallplatform/Public/Admin/js/publicjquery.js"></script>
    </head>
    <body style="background:#2b333e;" onselectstart="return false">
        <ul class="nav-first">
            <li>
                <a class="first" href="<?php echo U('Admin/index');?>" target="main">
                    <i class="iconfont icon-icon"></i>
                    <span>管理员账号管理</span>
                </a>
            </li>

            <li>
                <a class="first" href="<?php echo U('User/index');?>" target="main">
                    <i class="iconfont icon-liebiao"></i>
                    <span>会员管理</span>
                </a>
            </li>
            <li>
                <a class="first" href="<?php echo U('Order/index');?>" target="main">
                    <i class="iconfont icon-orders"></i>
                    <span>购买记录</span>
                </a>
            </li>
            <li>
                <a class="first" href="<?php echo U('Cash/index');?>" target="main">
                    <i class="iconfont icon-huodong"></i>
                    <span>提现申请</span>
                </a>
            </li>
            <li>
                <a class="first" href="<?php echo U('Bankname/index');?>" target="main">
                    <i class="iconfont icon-liebiao"></i>
                    <span>银行管理</span>
                </a>
            </li>
            <li>
                <a class="first" href="javascript:;">
                    <i class="iconfont icon-weiguanwangshezhi01"></i>
                    <span>积分商城管理</span>
                    <i class="iconfont down icon-xiajiantou"></i>
                    <i class="iconfont down up icon-shangjiantou"></i>
                </a>
                <ul class="nav-second">            
                    <li>
                        <a href="<?php echo U('Shop/index');?>" target="main">
                            商品列表
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Shop/add');?>" target="main">
                            添加商品
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('Shop/duihuan');?>" target="main">
                            兑换记录
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </body>
</html>