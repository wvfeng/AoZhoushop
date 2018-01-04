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
<script>
    $(function(){
　　    var dataId;
        var status;
        var one = true;
        $(".pop-up-head a").click(function(e){
            e.preventDefault();
            $(this).parents(".pop-up").parent().hide().removeClass("FromUpToDown");
        });
        $(".cancel").click(function(e){
            e.preventDefault();
            $(this).parents(".pop-up").parent().hide().removeClass("FromUpToDown");
        });
        $(".delete").click(function(){
            $(".pop-up-delete").show().addClass("FromUpToDown");
            dataId=$(this).attr('data-id');
        });
        $(".add").click(function(){
            $(".pop-up-add").show().addClass("FromUpToDown");
            dataId=$(this).attr('data-id');
        });
        $(".insert").click(function(){
        	if(one){
        		one = false;
        		var name = $('.name').val();
        		$.ajax({
        		    type: 'POST',
        		    url: "<?php echo U($Think.CONTROLLER_NAME.'/insert');?>",
        		    data: {name:name},
        		    dataType: 'json',
        		    success : function (data){
        		        layer.msg(data.info,{time:1000},function(){
        		         window.location.href = data.url;
        		        });
        		    }
        		});
        	}
        });
        $(document).on("change",".files",function(){
        
            var objUrl = getObjectURL(this.files[0]);
            console.log(objUrl);
            if (objUrl) {
                $(this).prev('img').attr("src",objUrl);
            }
        }) ;
        //建立一個可存取到該file的url
        function getObjectURL(file) {
            var url = null ;
            if (window.createObjectURL!=undefined) { // basic
                url = window.createObjectURL(file) ;
            } else if (window.URL!=undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file) ;
            } else if (window.webkitURL!=undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file) ;
            }
            return url ;
        }
        $('#filePic').click(function(){
        	if(one){
        		one=false;
        		$('#postform').ajaxSubmit({
        		    async : false,
        		    type : "POST",
        		    url : "<?php echo U($Think.CONTROLLER_NAME.'/insert');?>",
        		    dataType : "json",
        		    success :  function(res) {
        		        if(res.status == 1){
        		            layer.msg(res.info,{time:1000}, function () {
        		                window.location.href = res.url;
        		            });
        		        }else if(res.status == 0){
        		        	one=true;
        		            layer.msg(res.info,{time:1000});
        		        }else{
        		        	one=true;
        		        	layer.msg(res,{time:1000});
        		        }
        		    }
        		});
        	}
            return false;
        });
        $('#fileSave').click(function(){
            $('#postform').ajaxSubmit({
                async : false,
                type : "POST",
                url : "<?php echo U($Think.CONTROLLER_NAME.'/save');?>",
                dataType : "json",
                success :  function(res) {
                    if(res.status == 1){
                        layer.msg(res.info,{time:1000}, function () {
                            window.location.href = res.url;
                        });
                    }else{
                        layer.msg(res.info,{time:1000});
                    }
                }
            });
            return false;
        });
    });
</script>

    <div class="info-main main">
        <h1>管理员编辑 <a href="javascript:history.go(-1);"style="float:right;">返回上一级</a></h1>
        <form method="post" action="<?php echo U('Admin/save');?>" id="postform">
            <div class="info-list clearfix">
                <div class="info-right" style="width: 700px;">                  
                    <div class="info-model clearfix">
                        <span>账号名称</span>
                        <input type="hidden" name="id" value="<?php echo ($id); ?>">
                        <div><input type="text" name="name" value="<?php echo ($name); ?>" placeholder="账号名称"/></div>
                    </div>
                    <div class="info-model clearfix">
                        <span>密码</span>
                        <div><input type="text" name="password" placeholder="重置密码"/></div>
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
            <button class="info-submit" id="fileSave" style="cursor: pointer;">确定</button>
        </form>
    </div>


</body>
</html>