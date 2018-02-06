<?php
namespace Common\Controller;

class AddressController extends CommonController
{
    public $message = '收货地址';
    public $Model_class;

    public function Address($type,$id = null){
        $where = ['user_id'=>$this->userId,'id'=>$id];


        
        switch ($type){
            case 'add':
                $message = '添加';
                $this->Model->create();
                $this->Model->user_id = $this->userId;
                $res = $this->Model->add();
                break;
            case 'remove':
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
                $res = $this->Model->where($where)->select();
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