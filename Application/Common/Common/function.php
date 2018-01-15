<?php

/**
 * 自定义函数
 */

//对url中传递的敏感字段进行加密
function url_encode($enstr){
    $encode = trim(base64_encode($enstr),'=');
    $time = date('Y-m-d H:i:s');
    $head = trim(base64_encode(substr($encode,0,intval(strlen($encode)/2))),'=');
    $tail = trim(base64_encode(substr($encode,intval(strlen($encode)/2))),'=');
    if(date('d',strtotime($time))%2){
        $shuffle = $head.','.$tail;
    }else{
        $shuffle = $tail.','.$head;
    }
    $shuffle .= ','.trim(base64_encode(strtotime('+1 hours',strtotime(date('Y-m-d H',strtotime($time)).':00:00'))),'=');
    return trim(base64_encode($shuffle),'=');
}

//对url中加密传输的字段进行解密
function url_decode($destr){
    $encode = explode(',',base64_decode($destr));
    $entime = base64_decode(array_pop($encode));
    $time   = time();
    if($entime > $time){
        if(date('d',strtotime('-1 hours',strtotime(date('Y-m-d H',$entime).':00:00')))%2){
            $encode = base64_decode(array_shift($encode)).base64_decode(array_shift($encode));
        }else{
            $encode = base64_decode(array_pop($encode)).base64_decode(array_pop($encode));
        }
        return base64_decode($encode);
    }else{
        return false;
    }
}