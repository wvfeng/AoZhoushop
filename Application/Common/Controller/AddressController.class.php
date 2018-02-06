<?php
namespace Common\Controller;

class AddressController extends CommonController
{
    public $message = '收货地址';
    public $Model_class;

    public function Address($type,$id = null){
        switch ($type){
            case 'add':
                $message = '添加';
                $this->Model->create();
                $this->Model->user_id = $this->userId;
                $res = $this->Model->add();
                break;
            case 'remove':
                $message = '删除';
                $model = $this->Model->where(['user_id'=>$this->userId,'id'=>$id])->find();
                $res = $model->delete();
                break;
            case 'update':
                $message = '更新';
                $model = $this->Model->where(['user_id'=>$this->userId,'id'=>$id])->find();
                $res = $model->save();
                break;
            case 'list':
                $message = '查询';
                $res = $this->Model->where(['user_id'=>$this->userId,'id'=>$id])->select();
                break;
            case 'default':
                $message = '设置默认地址';
//                $this->Model->class = 'Common\Model\AddressModel';
//                $res = eval("return {$this->Model_class}".'::$a;');
                var_dump($this->Model);die;
                $model = $this->Model->where(['user_id'=>$this->userId,'id'=>$id])->find();
                var_dump($model);die;
                $res = $model->setField('sdefault',1);
                break;
            default :
                $message = 'Error';
                $res = null;
        }
        $this->quickReturn($res,$message == 'Error' ? '错误类型！操作':$message.$this->message);
    }
}