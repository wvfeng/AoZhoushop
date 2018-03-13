<?php
namespace Common\Controller;

use \Paypal\Api\Payer;
use \PayPal\Api\Item;
use \PayPal\Api\ItemList;
use \PayPal\Api\Details;
use \PayPal\Api\Amount;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payment;
use \PayPal\Exception\PayPalConnectionException;

class PaypalController
{

    private $pay;

    public function _initialize()
    {
        require "vendor/autoload.php"; //载入sdk的自动加载文件
        define('SITE_URL', 'http://www.paydemo.com'); //网站url自行定义
//创建支付对象实例
        $this->pay = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential(C('PAY_PAL')['Client_ID'], C('PAY_PAL')['Secret']));
    }

    public function checkout()
    {
        dump($this->pay);
    }


}