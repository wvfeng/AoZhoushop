<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta charset="utf-8"/>
    <title>澳洲商城</title>
</head>
<div style="width: 20px;height: 100%;position: absolute;left: 200px;top: 0;"></div>
    <frameset rows="50px,80%" border="0">
        <frame src="<?php echo U('Index/top');?>"  border="0"  scrolling="no">
        <frameset cols="220px,80%" border="0">
            <frame src="<?php echo U('Index/leftnav');?>"    border="0"  scrolling="auto">
            <frame src="<?php echo U('Index/shouye');?>" name="main" border="0"  scrolling="auto">
        </frameset>
    </frameset>
</html>