<?php

namespace Common\Controller;

/**
 * 电子邮件
 */
class EmailController extends CommonController
{
    public function SendEmail($title,$content,$Address,$Attachment = null){
        $Email = A('Common/Send','Email');
        $Email->SendEmail($title,$content,$Address,$Attachment = null);
    }
}