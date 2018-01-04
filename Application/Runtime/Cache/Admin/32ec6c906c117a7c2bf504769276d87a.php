<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="pragram" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>后台登录</title>
    <script type="text/javascript" src="/mallplatform/Public/Admin/js/jquery-1.11.1.min.js"></script>
    <style>
        .homeAdminContent{position: absolute;left:0;right: 0;bottom: 0;top:0;min-width: 1100px;min-height: 600px;}
        .footCopyright{position: absolute;left:0;right: 0;bottom: 0;line-height:35px;color:#fff;color:rgba(255,255,255,0.7);background-color:#333;background-color:rgba(0,0,0,0.5);font-size:12px;text-align: center;}
        .homeAdmin{position: absolute;left:0;right: 0;top: 0;bottom:0;background-size: cover;background-position: center;background-repeat: no-repeat;background-image: url(/mallplatform/Public/Admin/images/homeAdminBg.jpg);min-width: 1100px;text-align: center;}
        .homeAdmin>span{display: inline-block;height: 100%;vertical-align: middle;}
        .adminLoginForm{display: inline-block;vertical-align: middle;color:#fff;background-color: rgba(255,255,255,0.23);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#33000000,endColorstr=#33000000); 
            width:500px;padding:0 0 40px 0;border-radius: 10px;}
        .adminlogoHead{width:220px;margin-bottom:17px;}
        .adminForm{display:block;font-size:0;background:#fff;width:330px;margin:0 auto;margin-bottom:22px;border-radius: 5px;border:1px solid #fff;height: 45px;}
        input.adminForm{color:#fff;background-color:#ff4351;border: none;font-size:16px;font-weight: bold;outline: none;margin-top:30px; }
        input.adminForm:hover{background-color: #f92131;}
        .adminForm img{float:left;width:15px;margin-top:11px;margin-left:12px;}
        .adminForm input{float:right;font-size:14px;height:28px;width:296px;margin-top:7px;background-color: transparent;color:#666;border: none;outline: none;text-indent: 10px;font-size:15px;line-height: 28px;}
        .adminLoginForm h3{margin:50px 0 50px;font-size:40px;color:#fff;text-align:center;}
    </style>
</head>
<body>
<div class="homeAdminContent">
    <div class="homeAdmin">
        <!-- <div class="logo_tu" style="width: 200px;height: 50px;position: absolute;top: 40px;left: 45px;"><img src="/mallplatform/Public/Admin/images/yihui.png" alt=""></div> -->
        <span></span>
        <div class="big_box" style="width: 500px;height: 350px;position: absolute;top: 0;left: 0;right: 0;bottom:0;margin: auto;">
        <div class="adminLoginForm"> 
            <form method="post" action="<?php echo U('Login/login');?>">
                <!-- <img class="adminlogoHead" src="images/logoHead.png"/> -->
                <h3>欢迎登录会员系统</h3>
                <label class="adminForm">
                    <img src="/mallplatform/Public/Admin/images/account.png"/>
                    <input name="name" autocomplete="off" type="text" placeholder="请输入您的登录账号" />
                </label>
                <label class="adminForm">
                    <img src="/mallplatform/Public/Admin/images/password.png"/>
                    <input name="password" autocomplete="off" type="password" placeholder="请输入您的登录密码"/>
                </label>
                <input type="submit" class="adminForm" id="adminForm" value="登  录" style="cursor: pointer;"></input>
            </form>
        </div>
</div>
    </div>
    <div class="footCopyright"></div>
</div>
<style>
	.logo_tu img{
		width: 100%
	}
</style>
<script type="text/javascript">
    /*$("#adminForm").click(function(){
        var self = $("form");
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;

        function success(data){
            if(data.status == 0){
                alert(data.info);
            }else{
                window.location.href = data.url;
            }
        };
    });*/
    document.onkeydown=function(event){
        var e = event || window.event || arguments.callee.caller.arguments[0];          
        if(e && e.keyCode==13){ // enter 键
            var self = $("form");
            $.post(self.attr("action"), self.serialize(), success, "json");
            return false;

            function success(data){
                if(data.status == 0){
                    alert(data.info);
                }else{
                    window.location.href = data.url;
                }
            };
        }
    }; 
</script>
</body>
</html>