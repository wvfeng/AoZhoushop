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
    
    <div class="main">
        <div class="head-content">
            <div class="content" style="position: relative;">
                <a href="<?php echo U('Admin/add');?>" style="display: block;position:absolute;top:10px;right:10px;width: 100px;height: 36px;text-align: center;line-height: 36px;color: #fff;font-size: 14px;background: #34d1a1;border-radius:3px; ">添加</a>
                <form method="get" action="<?php echo U('Admin/index');?>">
                    <div class="head-title">管理员列表</div>
                    
                </form>
            </div>
        </div>
        <div class="table-list">
            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th>账号</th>
                    <th>创建时间</th>
                    <th>状态</th>
                    <th width="200">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                        <td class="color"><?php echo ($vo["name"]); ?></td>
                        <td class="color"><?php echo ($vo["create_time"]); ?></td>
                        <td class="color">
                            <?php if(($vo["status"]) == "1"): ?><span style="color:#34d1a1;">启用</span>/<a class="status" data-id="<?php echo ($vo["id"]); ?>" data-status="0" style="color:#666666;" href="<?php echo U('Admin/status',array('id'=>$vo['id'],'status'=>'0'));?>">停用</a><?php endif; ?>
                            <?php if(($vo["status"]) == "0"): ?><a class="status" data-id="<?php echo ($vo["id"]); ?>" data-status="1" style="color:#666666;" href="<?php echo U('Admin/status',array('id'=>$vo['id'],'status'=>'1'));?>">启用/<span style="color:red;">停用</span></a><?php endif; ?>
                        </td>
                        <td>
                            <div class="operate-list">
                                <a class="pen" style="line-height:22px;width:40px;" href="<?php echo U('Admin/edit',array('id'=>$vo['id']));?>" title="编辑">
                                    <i class="iconfont">编辑</i>
                                </a>
                                <a class="delete_o" style="line-height:22px;width:40px;" href="#" data-id="<?php echo ($vo["id"]); ?>" title="删除">
                                    <i class="iconfont">删除</i>
                                </a>
                            </div>
                        </td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <div class="page">
                <?php echo ($page); ?>
            </div>
            <style>
                .prev,.num,.next{width: 40px;border-radius: 3px;display: inline-block;width: 34px;height: 30px;margin-right: 6px;border: 1px solid #ddd;text-align: center;line-height: 30px;color: #727171;}
                .news-left .current{width: 40px;border-radius: 3px;display: inline-block;width: 34px;height: 30px;margin-right: 6px;border: 1px solid #ddd;text-align: center;line-height: 30px;color: #727171;}
                .table-list table img {
                    width: 60px;
                    margin: 0;
                }
            </style>
        </div>
        <script type="text/javascript">
            $(".status").click(function(){
                var id = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                $.ajax({
                    type: 'POST',
                    url: "<?php echo U('Admin/status');?>",
                    data: {id:id,status:status},
                    dataType: 'json',
                    success : function (data){
                         window.location.href = "<?php echo U('index');?>";
                    }
                });
                return false;
            });
            $('.delete_o').click(function(){
                $(".pop-up-delete").show();
                var id = $(this).attr('data-id');
                $('.entrue').click(function(){
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo U('Admin/del');?>",
                        data: {id:id},
                        dataType: 'json',
                        success : function (data){
                             window.location.href = "<?php echo U('index');?>";
                        }
                    });
                    return false;
                })
                

            })
        </script>
    </div>


</body>
</html>