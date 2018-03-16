<?php

/**
 * 自定义函数
 */

//对url中传递的敏感字段进行加密
function url_encode($enstr,$num = 1,$hours = 'hours'){
    $encode = trim(base64_encode($enstr),'=');
    $time = date('Y-m-d H:i:s');
    $head = trim(base64_encode(substr($encode,0,intval(strlen($encode)/2))),'=');
    $tail = trim(base64_encode(substr($encode,intval(strlen($encode)/2))),'=');
    if(date('d',strtotime($time))%2){
        $shuffle = $head.','.$tail;
    }else{
        $shuffle = $tail.','.$head;
    }
    $shuffle .= ','.trim(base64_encode(strtotime("+{$num} {$hours}",strtotime(date('Y-m-d H',strtotime($time)).':00:00')).",{$num},{$hours}"),'=');
    return trim(base64_encode($shuffle),'=');
}

//对url中加密传输的字段进行解密
function url_decode($destr){
    $timg_str = ['year','month','week','day','hour','Minute','second'];
    $encode = explode(',',base64_decode($destr));
    $entime = explode(',',base64_decode(array_pop($encode)));

    $hours  = array_pop($entime);
    if(!(in_array($hours,$timg_str) || in_array(rtrim($hours,'s'),$timg_str))) return false;
    $num    = array_pop($entime);
    $entime = array_pop($entime);
    $time   = time();
    if($entime > $time){
        if(date('d',strtotime("-{$num} {$hours}",strtotime(date('Y-m-d H',$entime).':00:00')))%2){
            $encode = base64_decode(array_shift($encode)).base64_decode(array_shift($encode));
        }else{
            $encode = base64_decode(array_pop($encode)).base64_decode(array_pop($encode));
        }
        return base64_decode($encode);
    }else{
        return false;
    }
}

function is_mobile($mobile){
    if(preg_match('/^1[3|4|5|7|8][0-9]{9}$/',$mobile) == 0){
        return false;
    }else{
        return true;
    }
}

function is_email($email,$type = 0){
    $email_en = '/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/';
    $email_ch = '/^[A-Za-z0-9\x7f-\xff]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/';
    switch ($type){
        case 0:
            $res = (boolean)(preg_match($email_en,$email) == 1 || preg_match($email_ch,$email) == 1);
            break;
        case 1:
            $res = (boolean)(preg_match($email_en,$email) == 1);
            break;
        case 2:
            $res = (boolean)(preg_match($email_ch,$email) == 1);
            break;
        default :
            $res = (boolean)(preg_match($email_en,$email) == 1 || preg_match($email_ch,$email) == 1);
            break;
    }
    return $res;
}

function is_idcard($idcard){
    if(preg_match('/^(\d{6})(18|19|20)?(\d{2})([01]\d)([0123]\d)(\d{3})(\d|X|x)?$/',$idcard) == 0){
        return false;
    }else{
        return true;
    }
}
?>