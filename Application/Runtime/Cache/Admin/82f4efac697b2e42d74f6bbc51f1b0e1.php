<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="pragram" content="no-cache">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>后台管理</title>
	<link href="/mallplatform/Public/Admin/css/swiper.css" rel="stylesheet" type="text/css">
	<link href="/mallplatform/Public/Admin/css/style.css" rel="stylesheet" type="text/css">
    <link href="/mallplatform/Public/Admin/css/user.css" rel="stylesheet" type="text/css">
	<link href="/mallplatform/Public/Admin/css/animate.css" rel="stylesheet" type="text/css">
	<link href="/mallplatform/Public/Admin/css/iconfont.css" rel="stylesheet" type="text/css">
	<script src="/mallplatform/Public/Admin/js/jquery-1.11.1.min.js"></script>
	<script src="/mallplatform/Public/Admin/js/publicjquery.js"></script>
	<script src="/mallplatform/Public/Admin/js/swiper.min.js"></script>
	<script type="text/javascript" src="/mallplatform/Public/Admin/js/echarts.min.js"></script>    
    <script src="/mallplatform/Public/Admin/js/jquery-ui.js"></script>
    <script src="/mallplatform/Public/Admin/js/CalendarHandler.js"></script>
    <script src="/mallplatform/Public/Index/js/layer.js"></script>
    <script src="/mallplatform/Public/Admin/laydate/laydate.js"></script>
    <script src="/mallplatform/Public/Admin/js/jquery.form.js"></script>
    <script src="/mallplatform/Public/Admin/js/plupload/plupload.full.min.js"></script>
    <script src="/mallplatform/Public/Admin/js/My97DatePicker/WdatePicker.js"></script>
	<style>
	    .current{
	        background: #34d1a1;
	        color: #fff;
	        display: inline-block;
	    }

	    .page span {
	        display: inline-block;
	        text-align: center;
	        margin-right: 6px;
	        width: 25px;
	        height: 25px;
	        vertical-align: 0px;
	    }
	    .checkboxist label{
	        float: left;
	        margin:5px;
	    }
	    .info-model>a{text-decoration:underline;margin-top:7px;cursor:pointer;}
	    .info-model>a:hover{color:#3ecd68;}
	</style>
</head>
<body>
<div class="pop-up-bj pop-up-delete none">
    <div class="pop-up">
        <div class="pop-up-head clearfix">
            <h3>温馨提示</h3>
            <a href="">×</a>
        </div>
        <div class="pop-up-main">
            <img src="/mallplatform/Public/Admin/images/tips.png" />
            <p>确定要这么做吗？</p> 
        </div>
        <div class="pop-up-submit pop-up-btn">
            <a href="javascript:;" class="hover entrue">确   定</a><a href="javascript:;" class="cancel">取   消</a>
        </div>
    </div>
</div>


    <div class="info-main main">
        <h1>管理员添加</h1>
        <form method="post" action="<?php echo U('Admin/insert');?>" id="postform">
            <div class="info-list clearfix">
                <div class="info-right" style="width: 700px;">                  
                    <div class="info-model clearfix">
                        <span>账号名称</span>
                        <div><input type="text" name="name" placeholder="账号名称"/></div>
                    </div>
                    <div class="info-model clearfix">
                        <span>密码</span>
                        <div><input type="text" name="password" placeholder="密码"/></div>
                    </div>
                    <div class="info-model clearfix">
                        <span>确认密码</span>
                        <div><input type="text" name="repassword" placeholder="确认密码"/></div>
                    </div>
                    
                    <div class="info-model clearfix checkboxist">
                        <span>是否开启</span>
                        <span style="overflow: hidden;line-height:15px;height: auto;float: left;width:457px;">
                            <label><input type="radio" name="status" checked value="1"/>开启</label>
                            <label><input type="radio" name="status" value="0"/>关闭</label>
                        </span>
                    </div>
                </div>
            </div>
            <button class="info-submit" type="submit" style="cursor: pointer;">确定</button>
        </form>
    </div>


</body>
</html>