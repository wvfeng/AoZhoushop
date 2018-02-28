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

        //读取配置文件
        $config = unserialize(base64_decode(C('EMAIL')));;
        /*服务器相关信息*/
        $this->IsSMTP();
        $this->SMTPAuth   = $config['SMTPAuth'];
        $this->Host       = $config['Host'];
        $this->Username   = $config['Username'];
        $this->Password   = $config['Password'];
        /*内容信息*/
        $this->IsHTML($config['IsHTML']);
        $this->CharSet    =$config['CharSet'];
        $this->From       = $config['From'];
        $this->FromName   =$config['FromName'];
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
        }else{
            self::logWrite($data,'ERR');
        }
    }

    private static function logWrite($data,$type = 'INFO',$logpath = null){
        $logpath = empty($logpath) ? C('LOG_PATH').date('y_m_d').'.log':$logpath;
        \Think\Log::write('Email:'.var_export($data,true),$type,'File',$logpath);
    }
}