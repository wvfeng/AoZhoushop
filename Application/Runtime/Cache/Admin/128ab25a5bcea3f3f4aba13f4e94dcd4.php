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

	<div class="main" >
        <!-- <div class="head-content">
            <div class="content" style="position: relative;">
                <form method="get" action="<?php echo U('Images/index');?>">
                    <div class="head-title">东风裕隆后台</div>
                    
                </form>
            </div>
        </div> -->
        <!-- 最新活动 -->
        <div class="head-content">
            <div class="content" style="position: relative;">
                <form method="get" action="<?php echo U('Images/index');?>">
                    <div class="head-title">最新活动</div>
                    
                </form>
            </div>
        </div>
        <div class="table-list" style="padding:15px 0;background:#fff;">
            <table cellpadding="0" cellspacing="0" >
                <thead>
                <tr>
                    <th>报名名称</th>
                    <th>报名签到数量</th>
                    <th>物料领取数量</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="color"><?php echo ($activity["name"]); ?></td>
                        <td class="color"><?php echo ($activity["sign_nums"]); ?></td>
                        <td class="color"><?php echo ($activity["materiel_nums"]); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
       
    
     <!-- 过往活动 -->
    <div class="activity"> 
        <div class="head-content">
            <div class="content" style="position: relative;">

                <a href="<?php echo U('Activity/index');?>" style="display: block;position:absolute;top:25px;right:0;width: 120px;height: 32px;text-align: center;line-height: 32px;color: #fff;font-size: 14px;background: #34d1a1;border-radius:3px; ">查看全部活动</a>
                <form method="get" action="<?php echo U('Images/index');?>">
                    <div class="head-title1" style="width:100%;">已结束的活动<span style="float:right;font-size:18px;margin:1px 146px 0 0;">总计:（<?php echo ($old_count); ?>）</span></div>
                    
                </form>
            </div>
        </div>
        <div class="table-list table-list1" style="padding:18px 0;background:#fff;">
            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th>活动名称</th>
                    <th>媒体人报名数</th>
                    <th>累计评价数</th>
                    <th>累计领取线下物料数</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(is_array($old_list)): foreach($old_list as $key=>$vo): ?><tr>
                            <td class="color"><?php echo ($vo["name"]); ?></td>
                            <td class="color"><?php echo ($vo["sign_nums"]); ?></td>
                            <td class="color"><?php echo $vo['evaluate_nums'] ? $vo['evaluate_nums'] : 0;?></td>
                            <td class="color"><?php echo ($vo["materiel_nums"]); ?></td>
                        </tr><?php endforeach; endif; ?>
                    
                </tbody>
            </table>
        </div>
    </div> 
</div>    
<style>
    
    .content{margin: 0px 13px;}
    .table-list tr:nth-child(odd) td{background:#fff;}
    .table-list table tr:nth-child(even) td{background:#fff;}
    .table-list thead th{color:#777;font-size:14px;}
    .table-list table tbody td{font-size:14px;font-weight:500;color:#333;}
    .table-list1 table tbody td{font-size:14px;}
    .table-list table tr{height: 36px;outline:0;}
    .table-list table th {height: 36px;}
    .head-content{height:70px;}
    .head-title{height:70px;line-height:70px;}
    .main{padding:0 0 33px 0;box-shadow:none;}
    .head-title1{padding:32px 0 20px;font-size: 20px;font-weight: 600;}
    .table-list table tr:hover{outline:0;}
    .table-list table tr:hover td{color:#26c1c2;background:#f4f4f4!important;}
    .table-list table th{background:#fff;}
    .table-list{margin:0 23px;box-shadow:none;border:1px solid #eee;}
    .activity{margin: 5px 0 15px;background:#fff;}
    .main-data{margin: -37px 36px 18px;padding:25px 23px 30px 23px;background:#fff;}
    .main-data>h3{margin-bottom:20px;font-weight:bold;font-size:20px;}
    .clearfix:after{clear:both;display:block;visibility:none;font-size:0;height:0;}
    .data-list{margin-bottom:36px;padding:25px 0;border:1px solid #eee;}
    .data-list>div{float:left;width:95px;margin-left:20%;}
    .data-list h4{margin-top:18px;color:#34d1a1;font-size:20px;text-align:center;}
    .data-list p{text-align:center;font-size:16px;}
    .data-number span,.data-number div{display:inline-block;vertical-align:middle;}
    .data-number span{margin-right:17px;}
    .data-number a{width:90px;height:30px;border-radius:3px;line-height:30px;text-align:center;display:inline-block;margin-right:10px;color:#fff;background:#34d1a1;}
    .data-time{margin-top:20px;}
    .info-foot{padding:25px 0 38px 23px;margin: 0 36px 15px;background:#fff;}
    .info-foot-left{float:left;}
    .info-foot-left{width:50%;}
    .info-foot-left>h3{font-size:20px;font-weight:bold;}
    .form{margin-left:66px;}
    .info-foot-left>div{margin-top:23px;padding:55px 0 20px 0px;border:1px solid #eee;}
    .info-foot-left p{float:left;width:42%;font-size:18px;text-align:right;margin:0 3% 60px 3%;}
    .info-foot-left p span{display:inline-block;width:60px;text-align:left;margin-left:10px;font-size:18px;}
    .info-foot-right{float:right;height:140px;padding:0 0 0 2%;width:47%;}
    .info-foot-right h3{font-size:20px;font-weight:bold;margin-bottom:23px;}
    .info-wrap>p{margin-bottom:26px;}
    .info-foot-right>div p span{float:left;margin-top:5px;margin-right:5%;}
    .info-wrap p strong{font-size:18px;font-weight:normal;}
    .info-wrap p a{float:left;border-radius:3px;font-size:12px;width:120px;text-align:center;height:30px;font-size:14px;line-height:30px;color:#fff;background: #34d1a1;}
    .info-list1 p{float:left;width:60%;margin-right:20%;height:20px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
    .info-list1{margin-bottom:13px;}
    .info-list1 a{float:left;width:80px;font-size:12px;border-radius:3px;text-align:center;padding:5px 0;color:#fff;background: #34d1a1;}
</style>
    <div class="main-data">
        <h3>稿件数据</h3>
        <div class="data-list clearfix">
            <div>
                <p>今日浏览量</p>
                <h4><?php echo ($today_watch); ?></h4>    
            </div>  
            <div>
                <p>今日分享量</p>
                <h4><?php echo ($today_share); ?></h4>    
            </div>
            <div>
                <p>今日下载量</p>
                <h4><?php echo ($today_download); ?></h4>    
            </div>
        </div>
        <div class="data-number">
            <span>类型: </span>
            <a style="<?php if($type == 1 ): ?>color:#fff;background:#34d1a1<?php else: ?>color:#555;background:#f4f4f4<?php endif; ?>" href="<?php echo U('shouye',array('type'=>'1',data=>$data));?>">浏览量</a>
            <a style="<?php if($type == 2 ): ?>color:#fff;background:#34d1a1<?php else: ?>color:#555;background:#f4f4f4<?php endif; ?>" href="<?php echo U('shouye',array('type'=>'2',data=>$data));?>">分享量</a>
            <a style="<?php if($type == 3 ): ?>color:#fff;background:#34d1a1<?php else: ?>color:#555;background:#f4f4f4<?php endif; ?>" href="<?php echo U('shouye',array('type'=>'3',data=>$data));?>">下载量</a>
        </div>
        <div class="data-number data-time">
            <span>时段: </span>
            <a style="<?php if($data == 1 ): ?>color:#fff;background:#34d1a1<?php else: ?>color:#555;background:#f4f4f4<?php endif; ?>" href="<?php echo U('shouye',array('data'=>'1',type=>$type));?>">最近一周</a>
            <a style="<?php if($data == 2 ): ?>color:#fff;background:#34d1a1<?php else: ?>color:#555;background:#f4f4f4<?php endif; ?>" href="<?php echo U('shouye',array('data'=>'2',type=>$type));?>">最近一月</a>
        </div>
        <div id="chartes" style="width: 100%;height:300px;margin-top:20px;margin-left:20px;"></div>
        <script type="text/javascript"> 
            var names = "<?php echo ($names); ?>";
            var myChart = echarts.init(document.getElementById('chartes'));
            option = {
                title: {
                    text: names
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data:[names]
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                toolbox: {
                    feature: {
                        saveAsImage: {}
                    }
                },
                xAxis: {
                    type: 'category',
                    boundaryGap: false,
                    data: ["<?php echo ($data1); ?>"]
                },
                yAxis: {
                    type: 'value'
                },
                series: [
                    {
                        name:names,
                        type:'line',
                        stack: '总量',
                        data:["<?php echo ($data2); ?>"]
                    }
                ]
            };
            myChart.setOption(option);
        </script>
    </div>
    <div class="info-foot clearfix">
        <div class="info-foot-left">
            <h3>媒体人信息</h3>
            <div class="clearfix">
                <p>媒体人总数<span> <?php echo ($user_count); ?></span></p>
                <p>所有活动媒体报名数<span><?php echo ($sign_count); ?></span></p>
                <p>总活动评价数量<span><?php echo ($evaluate_count); ?></span></p>
                <p>总领取线下物料数量<span><?php echo ($materiel_count); ?></span></p>
            </div>
        </div>
        <div class="info-foot-right">
            <h3>代办</h3>
            <div class="info-wrap" style="height:191px;border:1px solid #eee;padding:20px 18px 20px;">
                <p class="clearfix"><span>未处理的平台反馈数 <strong><?php echo ($feedback_no_count); ?></strong></span><a href="<?php echo U('Feedback/index');?>">全部反馈</a></p>
                <?php if(is_array($feedback_list)): foreach($feedback_list as $key=>$vo): ?><div class="info-list1 clearfix">
                    <p><?php echo ($vo["content"]); ?></p>
                    <a class="status" data-id="<?php echo ($vo["id"]); ?>" href="javascript:;">已阅</a>
                </div><?php endforeach; endif; ?>
            </div>
            <script type="text/javascript">
                $(".status").click(function(){
                    var id = $(this).attr('data-id');
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo U('Feedback/status');?>",
                        data: {id:id,status:'1'},
                        dataType: 'json',
                        success : function (data){
                            layer.msg(data.info,{time:1000},function(){
                             window.location.href = "<?php echo U('Index/shouye');?>";
                            });
                        }
                    });
                    return false;
                });
            </script>
        </div>
    </div>
    


</body>
</html>