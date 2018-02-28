<?php
//声明命名空间
namespace Common\Sms;

use Think\Sms;
class SendSms extends Sms
{
    //发送验证码
    public function SendSms($mobile = null,$code = null){
//        $mobile = '17826829936';
        $mobile = '17634313914';
        $code = rand ( 1000, 9999 );

        $status = $this->send_verify($mobile, $code);

        if (!$status) {
            echo $this->error;
        }else{
            echo 11111111;
        }
    }
}