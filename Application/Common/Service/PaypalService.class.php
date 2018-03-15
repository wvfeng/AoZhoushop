<?php
namespace Common\Service;

require "vendor/autoload.php"; //载入sdk的自动加载文件
define('SITE_URL', 'http://www.297buy.com'); //网站url自行定义

use Common\Controller\CommonController;
use \PayPal\Api\Payer;
use \PayPal\Api\Item;
use \PayPal\Api\ItemList;
use \PayPal\Api\Details;
use \PayPal\Api\Amount;
use PayPal\Api\PaymentExecution;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payment;
use \PayPal\Exception\PayPalConnectionException;


class PaypalService extends CommonController
{
    static $pay;
    static $payer;
    static $Item;
    static $ItemList;
    static $Details;
    static $Amount;
    static $Transaction;
    static $RedirectUrls;
    static $Payment;

    public function _initialize()
    {
        //创建支付对象实例
        self::$pay = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                C('PAY_PAL')['Client_ID'],
                C('PAY_PAL')['Secret']
            )
        );
        //创建支付属性
        self::$payer        = new Payer();
        self::$Item         = new Item();
        self::$ItemList     = new ItemList();
        self::$Details      = new Details();
        self::$Amount       = new Amount();
        self::$Transaction  = new Transaction();
        self::$RedirectUrls = new RedirectUrls();
        self::$Payment      = new Payment();
    }

    static public function checkout($param)
    {
        if (!isset($_POST['product'], $_POST['price'])) {
            die("lose some params");
        }
        $product    = $param['product'];
        $price      = $param['price'];
        $shipping   = 0.00; //运费
        $num        = 2; //数量
        //总价格
        $total = $price*$num + $shipping;
        self::$payer->setPaymentMethod('paypal');
        self::$Item->setName($product)
            ->setCurrency('USD')
            ->setQuantity($num)
            ->setSku("testpro1_01") // Similar to `item_number` in Classic API
            ->setPrice($price);

        self::$ItemList->setItems([self::$Item]);
        self::$Details->setShipping($shipping)
            ->setSubtotal($price*$num);

        self::$Amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails(self::$Details);

        self::$Transaction->setAmount(self::$Amount)
            ->setItemList(self::$ItemList)
            ->setDescription("支付描述内容")
            ->setInvoiceNumber('sdasdasdsadsdsdasdasdsadsadasd____zhangsan');
        //客户端通知
        self::$RedirectUrls->setReturnUrl(SITE_URL . '/notify.php?success=true')
            ->setCancelUrl(SITE_URL . '/notify.php?success=false');

        self::$Payment->setIntent('sale')
            ->setPayer(self::$payer)
            ->setRedirectUrls(self::$RedirectUrls)
            ->setTransactions([self::$Transaction]);
        try {
            self::$Payment->create(self::$pay);
        } catch (PayPalConnectionException $e) {

            echo $e->getData();
            die();
        }
        $approvalUrl = self::$Payment->getApprovalLink();
        return $approvalUrl;
    }

    static public function notify($param)
    {
        // ### Approval Status
        // Determine if the user approved the payment or not
        if (isset($param['success']) && $param['success'] == 'true') {

            // Get the payment Object by passing paymentId
            // payment id was previously stored in session in
            // CreatePaymentUsingPayPal.php
            $paymentId = $param['paymentId'];
            $payment = Payment::get($paymentId, self::$pay);

////            // ### Payment Execute
////            // PaymentExecution object includes information necessary
////            // to execute a PayPal account payment.
////            // The payer_id is added to the request query parameters
////            // when the user is redirected from paypal back to your site
//            $execution = new PaymentExecution();
//            $execution->setPayerId($param['PayerID']);
////
////            // ### Optional Changes to Amount
////            // If you wish to update the amount that you wish to charge the customer,
////            // based on the shipping address or any other reason, you could
////            // do that by passing the transaction object with just `amount` field in it.
////            // Here is the example on how we changed the shipping to $1 more than before.
//            $transaction = new Transaction();
//            $amount = new Amount();
//            $details = new Details();
////
//            $details->setShipping(0.00)
//                ->setSubtotal(70);
////
//            $amount->setCurrency('USD');
//            $amount->setTotal(85);
//            $amount->setDetails($details);
//            $transaction->setAmount($amount);
////
////            // Add the above transaction object inside our Execution object.
//            $execution->addTransaction($transaction);
//            try {
//                // Execute the payment
//                $result = $payment->execute($execution, self::$pay);
//                echo "支付成功";
//            } catch (Exception $ex) {
//                echo "支付失败";
//                exit(1);
//            }




           echo $payment;

        } else {
            echo "PayPal返回回调地址参数错误";
        }
    }

}
