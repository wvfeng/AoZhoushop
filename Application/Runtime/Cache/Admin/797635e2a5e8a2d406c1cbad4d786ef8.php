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
        <h1>商品添加</h1>
        <form method="post" action="<?php echo U('Shop/doadd');?>">
            <div class="info-list clearfix">
                <div class="info-right" style="width: 700px;">
                    <div class="info-model clearfix">
                        <span>选择品牌</span>
                        <div>
                            <select name="classify_id" class="is_vip" style="color: #666;width:199px;font-size: 14px;border:1px solid #eef1f1;border-radius:3px;height: 36px;margin-right: 5px;">
                                    <option value='0'>无</option>
                                    <?php if(is_array($classify)): $i = 0; $__LIST__ = $classify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["classname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="info-model clearfix"id="_type"style="width:800px;">
                        <span>选择类型</span>
                        <div style="width:199px;">
                            <select name="type" class="is_vip _type" style="color: #666;width:199px;font-size: 14px;border:1px solid #eef1f1;border-radius:3px;height: 36px;margin-right: 5px;">
                                    <option value='0'>无</option>
                                    <option value="今日上新">今日上新</option>
                                    <option value="今日特价">今日特价</option>
                                    <option value="热门品牌">热门品牌</option>
                                    <option value="会员特权">会员特权</option>
                            </select>
                        </div>
                    </div>
                    <script type="text/javascript">
                    $("._type").change(function(){
                        $('#_type').append("<input type='hidden' name='type_all[]' value='"+$(this).val()+"'><span><a title='点击删除' style='color:red;cursor: pointer;'>"+$(this).val()+"</a></span>");
                    })
                    $('#_type').delegate('a','click',function(){
                        $(this).parent().prev().remove();
                        $(this).parent().remove();
                    })
                    </script>
                    <div class="info-model clearfix">
                        <span>商品名称</span>
                        <div><input type="text" name="tit" value="" placeholder="名称"/></div>
                    </div>
                    <div class="info-model clearfix">
                        <span>商品名称(en)</span>
                        <div><input type="text" name="tit_en" value="" placeholder="名称(en)"/></div>
                    </div>
                    <div class="info-model clearfix">
                        <span>商品图片<br/>(390*260)</span>
                        <div style="height:80px;width:80px;">
                            <input type="hidden" name="img"value="">
                            <img src="/azshop/Public/Admin/images/up.jpg" style="width:80px;height:80px;cursor: pointer;" id="browse">
                        </div>
                    </div>
                    <div class="info-model clearfix">
                        <span>商品滚动图<br/>(690*410)</span>
                        <div style="height:80px;" class="slp">
                            <img src="/azshop/Public/Admin/images/up.jpg"style="width:80px;height:80px;cursor: pointer;" id="browse_slid">
                        </div>
                    </div>
                    <div class="info-model clearfix">
                        <span>所需现金</span>
                        <div><input type="number" name="price" value="" placeholder="现金"/></div>
                    </div>
                    <div class="info-model clearfix">
                        <span>商品规格</span>
                        <div><input type="text" name="specifications" value="" placeholder="规格"/></div>
                    </div>
                    <div class="info-model clearfix">
                        <span>商品产地</span>
                        <div><input type="text" name="origin" value="" placeholder="产地"/></div>
                    </div>
                    <div class="info-model clearfix">
                        <span>储存方法</span>
                        <div><input type="text" name="storage" value="" placeholder="储存方法"/></div>
                    </div>
                    <div class="info-model clearfix">
                        <span>商品汇率</span>
                        <div><input type="text" name="rate" value="" placeholder="汇率"/></div>
                    </div>
                    <div class="info-model clearfix">
                        <span>商品详情</span>
                        <div style="height:auto;">
                            <textarea name="detail" id="container" style="height:300px;width:800px" ></textarea>
                        </div>
                    </div>
                    <div class="info-model clearfix">
                        <span>商品详情(en)</span>
                        <div style="height:auto;">
                            <textarea name="detail_en" id="container_en" style="height:300px;width:800px" ></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button class="info-submit" type="submit">确定</button>
        </form>
    </div>
    <script>

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
    //上传滚动图
    //实例化一个plupload上传对象
    var uploader_slid = new plupload.Uploader({
        browse_button : 'browse_slid', //触发文件选择对话框的按钮，为那个元素id
        url : "<?php echo U('upload');?>", //服务器端的上传页面地址
        flash_swf_url : '/azshop/Public/admin/js/plupload/Moxie.swf', //swf文件，当需要使用swf方式进行上传时需要配置该参数
        silverlight_xap_url : '/azshop/Public/admin/js/plupload/Moxie.xap' //silverlight文件，当需要使用silverlight方式进行上传时需要配置该参数
    });    

    //在实例对象上调用init()方法进行初始化
    uploader_slid.init();
    //绑定各种事件，并在事件监听函数中做你想做的事
    uploader_slid.bind('FilesAdded',function(uploader_slid,files){
      uploader_slid.start();
    });
    uploader_slid.bind('FileUploaded',function(uploader_slid,files,responseObject){
      $('#browse_slid').before("<img style='width:80px;height:80px;'src='/azshop/Public/shopimg/"+responseObject.response+"'>");  
      $('#browse_slid').before("<input type='hidden' name='slide[]' value='"+responseObject.response+"'>");
      $('#browse_slid').before("<b class='sremove' style='margin:0 8px;cursor:pointer;'>删除</b>");
    });

    $('.slp').delegate('.sremove','click',function(){
        $(this).prev().prev().remove();
        $(this).prev().remove();
        $(this).remove();
    })
    </script>
    <script type='text/javascript' src='/azshop/Public/ueditor/ueditor.config.js'></script>
    <script type='text/javascript' src='/azshop/Public/ueditor/ueditor.all.min.js'></script>
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            toolbars: [['bold', //加粗
                    'fontfamily', //字体
                    'fontsize', //字号
                    'customstyle',
                    'simpleupload', //单图上传
                    'justifyleft', //居左对齐
                    'justifyright', //居右对齐
                    'justifycenter', //居中对齐
                    'justifyjustify', //两端对齐
                    'forecolor', //字体颜色
                    'fullscreen', //全屏
                    'imagenone', //默认
                    'imagecenter', //居中
                    'link',
                    'insertvideo',
                    'undo',
                    'redo',
                    'bold',
                    'italic',
                    'underline',
                    'fontborder',
                    'strikethrough',
                    'superscript',
                    'subscript',
                    'removeformat',
                    'formatmatch',
                    'autotypeset',
                    'pasteplain',
                    'forecolor',
                    'backcolor',
                    'insertorderedlist',
                    'insertunorderedlist',
                    'rowspacingtop',
                    'rowspacingbottom',
                    'lineheight',
                    'indent',
                    'unlink',
                    'insertimage',
                    'scrawl',
                    'music',
                    'attachment',
                    'map',
                    'insertframe',
                    'pagebreak',
                    'background',
                    'horizontal',
                    'date',
                    'time',
                    'snapscreen',
                    'inserttable',
                    'spechars',
                    'gmap',
                    'emotion',
                    'simpleupload',
                    'anchor',
                    'selectall',
                    'mergecells',
                    'mergeright',
                    'mergedown',
                    'charts',
                    'print',
                    'preview',
                    'searchreplace',
                    'help',
                    'drafts',
                ]]
        });
var ue_en = UE.getEditor('container_en', {
            toolbars: [['bold', //加粗
                    'fontfamily', //字体
                    'fontsize', //字号
                    'customstyle',
                    'simpleupload', //单图上传
                    'justifyleft', //居左对齐
                    'justifyright', //居右对齐
                    'justifycenter', //居中对齐
                    'justifyjustify', //两端对齐
                    'forecolor', //字体颜色
                    'fullscreen', //全屏
                    'imagenone', //默认
                    'imagecenter', //居中
                    'link',
                    'insertvideo',
                    'undo',
                    'redo',
                    'bold',
                    'italic',
                    'underline',
                    'fontborder',
                    'strikethrough',
                    'superscript',
                    'subscript',
                    'removeformat',
                    'formatmatch',
                    'autotypeset',
                    'pasteplain',
                    'forecolor',
                    'backcolor',
                    'insertorderedlist',
                    'insertunorderedlist',
                    'rowspacingtop',
                    'rowspacingbottom',
                    'lineheight',
                    'indent',
                    'unlink',
                    'insertimage',
                    'scrawl',
                    'music',
                    'attachment',
                    'map',
                    'insertframe',
                    'pagebreak',
                    'background',
                    'horizontal',
                    'date',
                    'time',
                    'snapscreen',
                    'inserttable',
                    'spechars',
                    'gmap',
                    'emotion',
                    'simpleupload',
                    'anchor',
                    'selectall',
                    'mergecells',
                    'mergeright',
                    'mergedown',
                    'charts',
                    'print',
                    'preview',
                    'searchreplace',
                    'help',
                    'drafts',
                ]]
        });
    </script>
    


</body>
</html>