<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="pragram" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>澳洲商城</title>
    <link href="/azshop/Public/Admin/css/style.css" rel="stylesheet" type="text/css">
    <link href="/azshop/Public/Admin/css/iconfont.css" rel="stylesheet" type="text/css">
    <script src="/azshop/Public/Admin/js/jquery-1.11.1.min.js"></script>
    
</head>
<body class="iframe-top" onselectstart="return false">
<div class="logo" style="text-align:left;">
	<a href="javascrit:;" style="color:#fff;font-weight: 600;font-size:24px;">
		<!-- <img src="/azshop/Public/Admin/images/logo.png" style="height:59px;padding-top:2px;"/>  -->
        <span style="display:inline-block;padding:12px 0 0 21px;">澳洲商城</span>
    </a>
</div>
<span style="float:left;height:50px;font-weight:bold;font-size:22px;line-height:50px;margin-left:24px;">澳洲商城后台</span>
<div class="personalInformation" >
	<div class="messages" style="display:none;">
		<a href="javascrit:;">
			<i class="iconfont">&#xe650;</i>
			<b class="color-bg-pink">3</b>
		</a>
	</div>
    
	<div class="messages" style="display:none;">
		<a href="javascrit:;">
			<i class="iconfont">&#xe62d;</i>
			<b class="color-bg-yellow">3</b>
		</a>
	</div>
	<div class="headimg" style="display:none;">
		<a href="javascrit:;">
			<img src="/azshop/Public/Admin/images/headimg.jpg"/>
		</a>
	</div>
	<div class="personal-name">
		<a href="javascrit:;">
			<span>欢迎<?php echo ($userinfo["name"]); ?>登陆</span>
		</a>
	</div>
	<a href="<?php echo U('Login/out');?>" target="_top" class="log-out"><i class="iconfont icon-zhuxiao" title="注销"></i></a>
</div>
</body>
</html>