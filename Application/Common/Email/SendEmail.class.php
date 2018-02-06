<?php
//声明命名空间
namespace Common\Email;
import("Org.Email.Mailer");
use Org\Email\Mailer;
/**
 * 快递查询
 */
class SendEmail extends Mailer
{
    public function SendEmail($title,$content,$Address,$Attachment = null){
        /*服务器相关信息*/
        $this->IsSMTP();
        $this->SMTPAuth   = true;
        $this->Host       = 'smtp.163.com';
        $this->Username   = 'wvfeng';
        $this->Password   = 'phpmail163';
        /*内容信息*/
        $this->IsHTML(true);
        $this->CharSet    ="UTF-8";
        $this->From       = 'wvfeng@163.com';
        $this->FromName   ="wvfeng";
        $this->Subject    = $title;
        $this->MsgHTML($content);
        if(is_array($Address)){
            foreach ($Address as $name=>$Addres){
                $this->AddAddress($Addres,is_numeric($name) ? null:$name);
            }
        }else{
            $this->AddAddress($Address);
        }
        empty($Attachment) || $this->AddAttachment($Attachment);
        $res = $this->Send();
        $data = [];
        array_push($data,$title,$content,$Address,$Attachment);
        if($res){
            self::logWrite($data);
            echo '444444';
        }else{
            self::logWrite($data,'ERR');
            echo '555555';
        }
    }

    private static function logWrite($data,$type = 'INFO',$logpath = null){
        $logpath = empty($logpath) ? C('LOG_PATH').date('y_m_d').'.log':$logpath;
        \Think\Log::write('Email:'.var_export($data,true),$type,'File',$logpath);
    }
}