<?php

namespace Common\Controller;

/**
 * 快递控制器
 */
class SelectController extends CommonController
{
    public function _before_autoSelectExpress($OrderCode = null){
        if(!empty($OrderCode)){
            if(!M('Order')->where(['id'=>$OrderCode,'user_id'=>$this->userId])->limit(1)->getField('id'))
                static::returnAjaxError(['message'=>'CODE_ORDER_ERR','status'=>'CODE_ORDER_ERR']);
        }
        return false;
    }

    public function autoSelectExpress($LogisticCode = null,$ShipperCode = null,$OrderCode = null){
        if(empty($LogisticCode) || empty($ShipperCode))
            static::returnAjaxError(['message'=>'缺少必要的参数，运单号或快递公司编码','status'=>'CODE_ARGUMENTS_ERROR']);
        //如果有缓存就返回缓存信息
        if(!empty(S(md5($OrderCode.$LogisticCode)))) static::quickReturn(S(md5($OrderCode.$LogisticCode)));

        //通过快递100查询快递信息
        $res = static::kuaidi100($LogisticCode,$ShipperCode);
        $data = json_decode($res,true);
        if($data['message'] == 'ok' && !empty($data['data'])){
            $Traces['LogisticCode'] = $data['nu'];
            $Traces['OrderCode'] = $OrderCode;
            $Traces['ShipperCode']  = $data['com'];
            $Traces['State']        = $data['state'];
            $Traces['Traces']       = $data['data'];
            static::ExpressReturn($Traces,md5($OrderCode.$LogisticCode));
        }

        //通过快递鸟查询快递信息
        $res = static::kuaidiniao($LogisticCode,$ShipperCode,$OrderCode);
        $data = json_decode($res,true);
        if($data['Success'] && !empty($data['Traces'])){
            $Traces['LogisticCode'] = $data['LogisticCode'];
            $Traces['OrderCode']    = $data['OrderCode'];
            $Traces['ShipperCode']  = $data['ShipperCode'];
            $Traces['State']        = $data['State'];
            $Traces['Traces']       = $data['Traces'];
            static::ExpressReturn($Traces,md5($OrderCode.$LogisticCode));
        }

        //查询失败
        static::quickReturn(null,'查询','GET');
    }
    //快递鸟
    private static function kuaidiniao($LogisticCode = null,$ShipperCode = null,$OrderCode = null){
        return (new \Common\Express\SelectExpress($LogisticCode,$ShipperCode,$OrderCode))->Send();
    }

    //快递100
    private static function kuaidi100($LogisticCode = null,$ShipperCode = null){
        $url = "www.kuaidi100.com/query?type={$ShipperCode}&postid={$LogisticCode}&temp=0.".time();
        if($res = file_get_contents('http://'.$url)){
            return $res;
        }else{
            return file_get_contents('https://'.$url);
        }
    }

    private static function ExpressReturn($res,$OrderCode){
        S($OrderCode,$res,1800);
        static::quickReturn($res,'查询','GET');
    }

    public function getKuaidi(){
        static::quickReturn(M('kuaidi_code')->limit($this->page())->select(),'查询','GET');
    }
}