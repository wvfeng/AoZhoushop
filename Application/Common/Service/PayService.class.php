<?php
namespace Common\Service;

use Common\Controller\CommonController;


class PayService extends CommonController
{


    /**
     * 创建属性
     */
    public function _initialize()
    {

    }

    /**
     * @param $data
     * @return bool
     * 验证
     */
     static function verified($data)
     {
         file_put_contents('tests.txt', json_encode($data));
         $req = 'cmd=_notify-validate';
         if (function_exists('get_magic_quotes_gpc')) $get_magic_quotes_exists = true;
         foreach ($data as $key => $value) {
             if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                 $value = urlencode(stripslashes($value));
             } else {
                 $value = urlencode($value);
             }
             $req .= "&$key=$value";
         }
         $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
         curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
         curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
         $res = curl_exec($ch);
         if (strcmp($res, "VERIFIED") == 0) {
             file_put_contents('test.txt', json_encode($res));
             self::Callback($data);
         } else if (strcmp($res, "INVALID") == 0) {
             return false;
         }
     }

    /**
     * @param $data
     * 回调
     */
    static public function Callback($data)
    {

    }

    /**
     * 检查订单信息是否正确
     */
    static public function checkOrder()
    {

    }
}
