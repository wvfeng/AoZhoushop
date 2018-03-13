<?php
namespace Admin\Service;

use Admin\Controller\CommonController;
use Admin\Model\OrderModel;

class OrderService extends CommonController
{
    /**
     * 订单列表
     */
    static public function orderList()
    {
        $model = new OrderModel();
        $count = $model->count();
        $p = self::getpage($count,5); //分页
        $data = $model->where(['status'=>1])->order('date desc')->limit($p->firstRow, $p->listRows)->select();
        $page =  $p->show();// 赋值分页输出
        return [
            'data'=>$data,
            'page'=>$page
        ];

    }

    /**
     * 订单详情数据
     */
    static public function orderDetails($oid)
    {
        
    }


}
