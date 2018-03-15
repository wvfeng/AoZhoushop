<?php
namespace Common\Controller;

use Common\Service\PaypalService;

class PaypalController extends PaypalService
{
    public function checkouta($param)
    {
        return PaypalService::checkout($param);
    }
    public function huidiao($param)
    {
        return PaypalService::notify($param);
    }
}