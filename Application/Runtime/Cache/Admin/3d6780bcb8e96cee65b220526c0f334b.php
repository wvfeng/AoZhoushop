<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="pragram" content="no-cache">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>后台管理</title>
	<link href="/azshop/Public/Admin/css/swiper.css" rel="stylesheet" type="text/css">
	<link href="/azshop/Public/Admin/css/style.css" rel="stylesheet" type="text/css">
    <link href="/azshop/Public/Admin/css/user.css" rel="stylesheet" type="text/css">
	<link href="/azshop/Public/Admin/css/animate.css" rel="stylesheet" type="text/css">
	<link href="/azshop/Public/Admin/css/iconfont.css" rel="stylesheet" type="text/css">
	<script src="/azshop/Public/Admin/js/jquery-1.11.1.min.js"></script>
	<script src="/azshop/Public/Admin/js/publicjquery.js"></script>
	<script src="/azshop/Public/Admin/js/swiper.min.js"></script>
	<script type="text/javascript" src="/azshop/Public/Admin/js/echarts.min.js"></script>    
    <script src="/azshop/Public/Admin/js/jquery-ui.js"></script>
    <script src="/azshop/Public/Admin/js/CalendarHandler.js"></script>
    <script src="/azshop/Public/Index/js/layer.js"></script>
    <script src="/azshop/Public/Admin/laydate/laydate.js"></script>
    <script src="/azshop/Public/Admin/js/jquery.form.js"></script>
    <script src="/azshop/Public/Admin/js/plupload/plupload.full.min.js"></script>
    <script src="/azshop/Public/Admin/js/My97DatePicker/WdatePicker.js"></script>
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
            <img src="/azshop/Public/Admin/images/tips.png" />
            <p>确定要这么做吗？</p> 
        </div>
        <div class="pop-up-submit pop-up-btn">
            <a href="javascript:;" class="hover entrue">确   定</a><a href="javascript:;" class="cancel">取   消</a>
        </div>
    </div>
</div>


    <div class="info-main main FromUpToDown">
        <h1>分类编辑 <a href="javascript:history.go(-1);"style="float:right;">返回上一级</a></h1>
        <form method="post" action="<?php echo U('doadd');?>" id="postform">
            <div class="info-list clearfix">
                <div class="info-right" style="width: 700px;">
                    <div class="info-model clearfix">
                        <span>上级分类</span>
                        <div>
                            <select name="uid" class="is_vip" style="color: #666;width:199px;font-size: 14px;border:1px solid #eef1f1;border-radius:3px;height: 36px;margin-right: 5px;">
                                    <option value='0'>顶级类别</option>
                                    <?php if(is_array($one)): $i = 0; $__LIST__ = $one;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"<?php if($v['id'] == $res['uid']): ?>selected="selected"<?php endif; ?>><?php echo ($v["classname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="info-model clearfix">
                        <span>分类名称</span>
                        <div><input type="text" name="classname" value="<?php echo ($res["classname"]); ?>" placeholder="分类名称"/></div>
                    </div>
                    <div class="info-model clearfix">
                    <span>商品图片<br/>390*260</span>
                    <div style="height:80px;">
                        <input type="hidden" name="img"value="<?php echo ($res["img"]); ?>">
                        <img src="/azshop/Public/shopimg/<?php echo ($res["img"]); ?>"style="width:80px;height:80px;" id="browse">
                    </div>
                </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo ($res["id"]); ?>">
            <button class="info-submit" type="submit">确定</button>
        </form>
    </div>
    <script type="text/javascript">
    //实例化一个plupload上传对象
    var uploader = new plupload.Uploader({
        browse_button : 'browse', //触发文件选择对话框的按钮，为那个元素id
        url : "<?php echo U('upload');?>", //服务器端的上传页面地址
        flash_swf_url : '/azshop/Public/admin/js/plupload/Moxie.swf', //swf文件，当需要使用swf方式进行上传时需要配置该参数
        silverlight_xap_url : '/azshop/Public/admin/js/plupload/Moxie.xap' //silverlight文件，当需要使用silverlight方式进行上传时需要配置该参数
    });    

    //在实例对象上调用init()方法进行初始化
    uploader.init();
    //绑定各种事件，并在事件监听函数中做你想做的事
    uploader.bind('FilesAdded',function(uploader,files){
      uploader.start();
    });
    uploader.bind('FileUploaded',function(uploader,files,responseObject){
      $('#browse').attr("src","/azshop/Public/shopimg/"+responseObject.response+"");
      $("input[name='img']").val(responseObject.response);
    });
    </script>


</body>
</html>