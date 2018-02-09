<?php
namespace Common\Controller;

class AddressController extends CommonController
{
    public $message = '收货地址';

    public function manage($type,$id = null){
        $where = ['user_id'=>$this->userId,'id'=>$id];
        switch ($type){
            case 'add':
                $message = '添加';
                $data = $this->Model->create();
                if($this->Model->checkFields($data)){
                    $this->Model->user_id = $this->userId;
                    $res = $this->Model->add();
                }else{
                    $res = false;
                }
                break;
            case 'c':
                $message = '删除';
                $res = $this->Model->where($where)->delete();
                $res = $res === false ? $res:true;
                break;
            case 'update':
                $message = '更新';
                $this->Model->where($where)->find();
                $this->Model->create();
                $res = $this->Model->save();
                $res = $res === false ? $res:true;
                break;
            case 'list':
                $message = '查询';
                $res = $this->Model->where($where)->limit($this->page())->select();
                break;
            case 'default':
                $message = '设置默认地址';
                $res = $this->Model->setDefault($where);
                break;
            default :
                $message = 'Error';
                $res = null;
        }
        $this->quickReturn($res,$message == 'Error' ? '错误类型！操作':$message.$this->message);
    }
}