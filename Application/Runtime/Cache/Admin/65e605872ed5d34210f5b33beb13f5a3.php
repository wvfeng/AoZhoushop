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

 
<style>
    .head-title{width:300px;float:none;height:auto;line-height:1;padding:10px 0 0;}
    .head-text{float:left;margin:6px 0px 0px 0px;}
</style>   
    <div class="main">
        <div class="head-content">
            <div class="content" style="position: relative;">
                <form action="<?php echo U('index');?>" method="get" style="float:right;">
                    <input type="hidden" name="excel" value="1">
                    <input type="submit" class="form-button color-bg-green" value="导出" style="width: 80px;">
                </form>
                <form method="get" action="<?php echo U('index');?>">
                    <div style="float:left;height:55px;">
                        <div class="head-title">会员列表</div>
                        <!-- <div class="head-text" style="">
                            推广大使：<?php echo ((isset($count_user["yi"]) && ($count_user["yi"] !== ""))?($count_user["yi"]):"-"); ?>人 创业合伙人：<?php echo ((isset($count_user["er"]) && ($count_user["er"] !== ""))?($count_user["er"]):"-"); ?>人 未付费：<?php echo ((isset($count_user["san"]) && ($count_user["san"] !== ""))?($count_user["san"]):"-"); ?>人 
                        </div> -->
                    </div>    
                        <div class="head-search" style="margin-right: 0px;">
                            <div class="form-input-btn" style="margin-left: 10px;cursor: pointer;">
                                <!-- <select name="clsea" class="is_vip" style="color: #666;width:199px;font-size: 14px;border:1px solid #eef1f1;border-radius:3px;height: 36px;margin-right: 5px;" id="clsea">
                                    <option value='1'>昵称/姓名/手机号</option>
                                    <option value='2'>级别</option>
                                    <option value='3'>购卡类型</option>
                                </select> -->
                                <input type="hidden" name="clsea" value="1" class="clsea">
                            </div>
                            <div class="form-input-btn select_1">                                <input style="width:230px;" type="text" name="clvar" class="form-input-small" placeholder="请输入昵称" id="clvar" value="<?php echo ($clvar); ?>">
                            </div>
                            <div class="form-input-btn select_2">
                                <select name="clsea_grade"style="color: #666;width:159px;font-size: 14px;border:1px solid #eef1f1;border-radius:3px;height: 36px;margin-right: 5px;">
                                    <option value='0'>选择级别</option>
                                    <?php if(is_array($grade)): $i = 0; $__LIST__ = $grade;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value='<?php echo ($v["id"]); ?>'<?php if($v['id'] == $clsea_grade): ?>selected="selected"<?php endif; ?>><?php echo ($v["lev_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
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
        $('.select_2').click(function(){
            $('.clsea').val(2);
        })
        $('.select_3').click(function(){
            $('.clsea').val(3);
        })
        </script>
        <div class="table-list">
            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th style="width: 7%">手机号</th>
                    <th style="width: 7%">email</th>
                    <th style="width: 5%">头像</th>
                    <th style="width: 10%">昵称</th>
                    <th style="width: 10%">时间</th>
                    <th style="width: 7%">余额 
                        <?php if($order == 'desc'): ?><a href="<?php echo U('index',['order'=>'asc']);?>"><span style="color:#999;font-size:16px;margin-right:2px;">↑</span><span style="color:#999;font-size:16px;">↓</span></a>
                        <?php else: ?>
                        <a href="<?php echo U('index',['order'=>'desc']);?>"><span style="color:#999;font-size:16px;margin-right:2px;">↑</span><span style="color:#999;font-size:16px;">↓</span></a><?php endif; ?>
                    </th>
                    <th style="width: 7%">积分</th>
                    <th style="width: 18%">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                      <td><?php echo ($v["user"]["iphone"]); ?></td>
                      <td><?php echo ($v["user"]["email"]); ?></td>
                      <td><img src="<?php echo ($v["headimgurl"]); ?>"style="width:40px;height:40px;"> </td>
                      <td> <?php echo ((isset($v["nickname"]) && ($v["nickname"] !== ""))?($v["nickname"]):"-"); ?> </td>
                      <td> <?php echo ($v["date"]); ?> </td>
                      <td class="surplus-money"> <?php echo ((isset($v["surplus_money"]) && ($v["surplus_money"] !== ""))?($v["surplus_money"]):"-"); ?> </td>
                      <td> <?php echo ((isset($v["surplus_int"]) && ($v["surplus_int"] !== ""))?($v["surplus_int"]):"-"); ?> </td>
                      <td>-</td>
                      <!-- <td>
                        <a href="<?php echo U('duihuan',['id'=>$v['id']]);?>" style="display:inline-block;padding:2px 4px;background:rgb(52, 209, 161);color:#fff;border-radius:3px;">订单</a>
                                          </td> -->
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