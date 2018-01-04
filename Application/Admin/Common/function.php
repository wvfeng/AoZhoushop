<?php
//查找下一级
function again($arr){
	foreach ($arr as $key => $v) {
		$date = M('referees')->where(['send_user_id'=>$v['get_user_id']])->select();
		if($date!=null){
			again($date);
		}
		file_put_contents("./Public/tuijianren.txt",serialize($v)."|x|",FILE_APPEND);
	}
}


?>