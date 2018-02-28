<?php
//声明命名空间
namespace Common\Sms;

use Think\Sms;
class SendSms extends Sms
{
    //发送验证码
    public function SendSms($mobile,$code){
        $status = $this->send_verify($mobile, $code);
        if($status !== true) \Think\Log::write($this->getError(),'ERR');
    }
}