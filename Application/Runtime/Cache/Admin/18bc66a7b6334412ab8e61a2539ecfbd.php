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

  
<style>
    .head-title{float:left;height:auto;line-height:1;padding:15px 0 0;}
    .head-text{float:left;margin:6px 0px 0px 0px;}
</style>   
    <div class="main">
        <div class="head-content">
            <div class="content" style="position: relative;">
                <form method="get" action="<?php echo U('index');?>">
                   <div style="float:left;height:55px;">
                        <div class="head-title">会员列表</div>
                        <div class="head-text" style="margin:15px 0 0 10px;">
                            推广大使：<?php echo ($count_user["er"]); ?>元 创业合伙人：<?php echo ($count_user["san"]); ?>元 <br/>积分商品：<?php echo ($count_user["yi"]); ?>元 累计收款：<?php echo ($count_user["si"]); ?>元
                        </div>
                    </div>
                   
                        <div class="head-search" style="margin-right: 0px;">
                            <div class="form-input-btn" style="margin-left: 10px;cursor: pointer;">
                                <!-- <select name="clsea" class="is_vip" style="color: #666;width:199px;font-size: 14px;border:1px solid #eef1f1;border-radius:3px;height: 36px;margin-right: 5px;" id="clsea">
                                    <option value='1'>昵称/姓名/手机号</option>
                                    <option value='2'>购买日期</option>
                                </select> -->
                                <input type="hidden" name="clsea" value="" class="clsea">
                            </div>
                            <div class="form-input-btn select_1">
                                              
                                <input style="width:200px;" type="text" name="clvar" class="form-input-small clvar" placeholder="请输入昵称/姓名/手机号" value="<?php echo ($clvar); ?>">
                            </div>
                            <div class="form-input-btn select_2">
                                              
                                <input style="width:160px;" type="text" name="clvar_date" class="form-input-small clvar" placeholder="请输入购买日期"onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($clvar_date); ?>">
                                至
                            </div>

                            <div class="form-input-btn select_3">
                                              
                                <input style="width:160px;" type="text" name="clvar_date_er" class="form-input-small clvar" placeholder="请输入购买日期"onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($clvar_date_er); ?>">
                            </div>
                            <input type="submit" class="form-button color-bg-green" value="查找" style="width: 80px;">&nbsp;
                        </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
        $('.select_1').click(function(){
            $('.clsea').val(1);
        })
                </script>
        <div class="table-list">
            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th style="width: 5%">头像</th>
                    <th style="width: 10%">昵称</th>
                    <th style="width: 8%">收货姓名</th>
                    <th style="width: 15%">收货地址</th>
                    <th style="width: 7%">消费类型</th>
                    <th style="width: 7%">花费金额</th>
                    <th style="width: 7%">购买时间</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                      <td><img src="<?php echo ($v["headimgurl"]); ?>"style="width:40px;height:40px;"> </td>
                      <td> <?php echo ($v["nickname"]); ?> </td>
                      <td> <?php echo ($v["name"]); ?> </td>
                      <td> <?php echo ($v["address"]); ?> </td>
                      <td> 
                        <?php if($v['classify'] == 1): ?>积分商品<?php endif; ?>
                        <?php if($v['classify'] == 2): ?>卡片一<?php endif; ?> 
                        <?php if($v['classify'] == 3): ?>卡片二<?php endif; ?> 
                      </td>
                      <td class="surplus-money"> <?php echo ($v["money"]); ?> </td>
                      <td> <?php echo ($v["date"]); ?> </td>
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
                    margin: 0;
                }
                .photo:hover div{display:block!important;}
            </style>
        </div>
    </div>
    <script>
    $(".surplus-money").each(function(){
        var num =parseFloat($(this).text(),10); 
       
        var n = num.toFixed(1); 
        $(this).text(n);
    });
       
    </script>


</body>
</html>