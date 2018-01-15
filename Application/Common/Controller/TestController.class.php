<?php

namespace Common\Controller;

/**
 * 测试专用
 */
class TestController extends CommonController
{
    //快递鸟
    public function kuaidiniao(){
        //接收数据
        //运单编号  必须
        $LogisticCode = I('request.LogisticCode');
        //快递公司  必须
        $ShipperCode  = I('request.ShipperCode');
        //订单编号 非必需
        $OrderCode    = I('request.OrderCode');
        //如果有缓存就返回缓存信息
        if(!empty(S($OrderCode))) $this->ajaxReturn(S($OrderCode));
        /*
         //方式一
         $data = [
             //运单编号  必须
            'LogisticCode' => '3350162158341',
            //快递公司  必须
            'ShipperCode'  => 'STO',
             //订单编号 非必需
            'OrderCode'    => ''
        ];
        $SelectEvent = new \Home\Express\SelectExpress($data);
        */

        /*
         //方式二
            //运单编号  必须
            $LogisticCode = '3350162158341',
            //快递公司  必须
            $ShipperCode = 'STO',
            //订单编号 非必需
            $OrderCode = ''
          $SelectEvent = new \Home\Express\SelectExpress($LogisticCode,$ShipperCode,$OrderCode);
        */

        $order = M('order')->where(array("id"=>$_GET['id']))->find();
        var_dump($order);
        //方式三
        $SelectEvent = A('Select','Express');
        $SelectEvent->OrderCode    = $order['sn'];
        $SelectEvent->ShipperCode  = $order['express_code'];
        $SelectEvent->LogisticCode = $order['express'];


        //以上三种方式任选一种
        $res = $SelectEvent->Send();
        $data = json_decode($res,true);
        if($data['Success']){
            //如果获取成功，缓存30分钟
            S($OrderCode,$data,1800);
        }
        var_dump($data);
        $this->dispaly();
//        $this->ajaxReturn($data);
    }

    //快递100
    public function kuaidi100(){
        //运单编号  必须
        $LogisticCode = I('request.LogisticCode');
        //快递公司  必须
        $ShipperCode = I('request.ShipperCode');
        //订单编号 非必需
        $OrderCode = I('request.OrderCode');

        //模拟数据
        //运单编号  必须
        $LogisticCode = '3350162158341';
        //快递公司  必须
        $ShipperCode = 'shentong';
        //订单编号 非必需
        $OrderCode = 'H4564512455';
        if(!empty(S($OrderCode))) $this->ajaxReturn(S($OrderCode));
        $url = "https://www.kuaidi100.com/query?type={$ShipperCode}&postid={$LogisticCode}&temp=0.".time();

        $res = file_get_contents($url);
        $data = json_decode($res,true);
        if($data['Success']){
            //如果获取成功，缓存30分钟
            S($OrderCode,$data,1800);
        }
//        $this->assign('data',$data)->dispaly();
        $this->ajaxReturn($data);
    }
}