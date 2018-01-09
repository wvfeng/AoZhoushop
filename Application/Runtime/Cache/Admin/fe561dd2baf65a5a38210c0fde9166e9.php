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


    <div class="main">
        <div class="head-content">
            <div class="content" style="position: relative;">
                <a href="<?php echo U('add');?>" style="display: block;position:absolute;top:10px;right:10px;width: 100px;height: 36px;text-align: center;line-height: 36px;color: #fff;font-size: 14px;background: #34d1a1;border-radius:3px; ">添加</a>
                    <div class="head-title">分类列表</div>
            </div>
        </div>
        <div class="table-list">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>名称</th>
                        <th>等级</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                            <td class="color"><?php echo ((isset($v["classname"]) && ($v["classname"] !== ""))?($v["classname"]):"-"); ?></td>
                            <td class="color"><?php echo ((isset($v["level"]) && ($v["level"] !== ""))?($v["level"]):"-"); ?></td>
                            <td>
                                <div class="operate-list">
                                    <a class="pen" style="line-height:22px;width:40px;" href="<?php echo U('edit',array('id'=>$v['id']));?>" title="编辑">
                                        <i class="iconfont">编辑</i>
                                    </a>
                                    <a class="delete" style="line-height:22px;width:40px;" href="#" data-id="<?php echo ($v["id"]); ?>" title="删除">
                                        <i class="iconfont">删除</i>
                                    </a>
                                </div>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
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
                }
                .photo:hover div{display:block!important;}
            </style>
        </div>

    </div>
    <script type="text/javascript">
        $(".delete").click(function(){
            var id = $(".delete").attr('data-id');
            $.ajax({
                type: 'POST',
                url: "<?php echo U('remove');?>",
                data: {id:id},
                dataType: 'json',
                success : function (data){
                    if(data==1){
                        window.location.href = "<?php echo U('index');?>";
                    }else{
                        alert('删除失败');
                    }
                    
                }
            });
        });
    </script>
    <script>
    $(".surplus-money").each(function(){
        var num =parseFloat($(this).text(),10); 
        var n = num.toFixed(1); 
        $(this).text(n);
    });
       
    </script>


</body>
</html>