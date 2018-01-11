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

    
    <div class="main">
        <div class="head-content">
            <div class="content" style="position: relative;">
                    <div class="head-title"><?php echo ($nickname); ?>的兑换记录</div>
                    <div class="head-text" style="float: left;margin-top: 20px;margin-left: 10px;">
                            累计积分：<?php echo ((isset($leiji["integral"]) && ($leiji["integral"] !== ""))?($leiji["integral"]):"-"); ?>分 累计金额：<?php echo ((isset($leiji["money"]) && ($leiji["money"] !== ""))?($leiji["money"]):"-"); ?>元
                        </div>
                    <form method="get" action="<?php echo U('duihuan');?>">
                    <!-- <div style="float:left;margin:23px 0px 0px 10px;">
                        总计: <?php echo ((isset($count_user) && ($count_user !== ""))?($count_user):"0"); ?> 人
                    </div> -->
                    <div class="head-title"style="float:right;">
                    <a href="javascript:history.go(-1);">返回上一级</a>
                    </div>
                        <div class="head-search" style="margin-right: 0px;">
                            <div class="form-input-btn" style="margin-left: 10px;cursor: pointer;">
                                <!-- <select name="clsea" class="is_vip" style="color: #666;width:199px;font-size: 14px;border:1px solid #eef1f1;border-radius:3px;height: 36px;margin-right: 5px;" id="clsea">
                                    <option value='1'>商品名称/收件人/手机号</option>
                                    <option value='2'>兑换时间</option>
                                </select> -->
                                <input type="hidden" name="clsea" value="" class="clsea">
                            </div>
                            <div class="form-input-btn select_1">                                <input style="width:238px;" type="text" name="clvar" class="form-input-small" placeholder="请输入商品名称/收件人/手机号" id="clvar">
                            </div>
                            <div class="form-input-btn select_2">
                                              
                                <input style="width:238px;" type="text" name="clvar_date" class="form-input-small clvar" placeholder="请输入购买日期"onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});">
                                至
                            </div>
                            <div class="form-input-btn select_3">
                                              
                                <input style="width:238px;" type="text" name="clvar_date_er" class="form-input-small clvar" placeholder="请输入购买日期"onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});">
                            </div>
                            <input type="hidden" name="id" value="<?php echo ($id); ?>">
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
                /*$('#clsea').change(function(){
                  if($(this).val()=='1'){
                    $('.clvar').attr('placeholder','请输入商品名称/收件人/手机号');
                    $('.select_1').show();
                    $('.select_2').hide();
                  }
                  if($(this).val()=='2'){
                    $('.clvar').attr('placeholder','请输入购买日期');
                    $('.select_2').show();
                    $('.select_1').hide();
                  }
                })*/
                </script>
        <div class="table-list">
            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th style="width: 8%">类型</th>
                    <th style="width: 10%">名称</th>
                    <th style="width: 6%">消费积分</th>
                    <th style="width: 6%">消费金额</th>
                    <th style="width: 5%">收件人</th>
                    <th style="width: 7%">物流公司</th>
                    <th style="width: 7%">物流编号</th>
                    <th style="width: 7%">手机号</th>
                    <th style="width: 10%">地址</th>
                    <th style="width: 10%">时间</th>
                    <th style="width: 10%">状态</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
                      <td> 
                        <?php if($v['classify'] == 1): ?>积分商品<?php endif; ?>
                        <?php if($v['classify'] == 2): ?>会员卡一<?php endif; ?>
                        <?php if($v['classify'] == 3): ?>会员卡二<?php endif; ?>
                      </td>
                      <td> <?php echo ($v["shop_name"]); ?> </td>
                      <td> <?php echo ($v["integral"]); ?> </td>
                      <td> <?php echo ($v["money"]); ?> </td>
                      <td> <?php echo ($v["name"]); ?> </td>
                      <td> <?php echo ($v["log"]); ?> </td>
                      <td> <?php echo ($v["no"]); ?> </td>
                      <td> <?php echo ($v["iphone"]); ?> </td>
                      <td> <?php echo ($v["address"]); ?> </td>
                      <td> <?php echo ($v["date"]); ?> </td>
                      <td>
                      <?php if($v['type'] == 1): ?>待发货<?php endif; ?>
                        <?php if($v['type'] == 2): ?>待收货<?php endif; ?>
                        <?php if($v['type'] == 3): ?>已完成<?php endif; ?> 
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
                    margin: 0;
                }
                .photo:hover div{display:block!important;}
            </style>
        </div>
    </div>


</body>
</html>