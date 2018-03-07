<?php
namespace Common\Controller;

class AddressController extends CommonController
{
    public $message = '收货地址';

    public function manage($type = 'list',$id = null){
        $where = ['user_id'=>$this->userId];
        if(is_numeric($id)) $where['id'] = $id;
        switch (strtolower($type)){
            case 'add':
                $message = '添加';
                $data = $this->Model->create();
                if($this->Model->checkFields($data)){
                    $this->Model->user_id = $this->userId;
                    $res = $this->Model->add();
                }else{
                    $res = false;
                }
                if($res === false){
                    $message .= $this->message;
                    if($this->Model->Error) $message = $this->Model->Error;
                    $this->returnAjaxError(['message'=>$message]);
                }
                break;
            case 'remove':
                $message = '删除';
                $res = $this->Model->where($where)->delete();
                $res = $res === false ? $res:true;
                break;
            case 'delete':
                $this->manage('remove',$id);
                break;
            case 'update':
                $message = '更新';
                $data = $this->Model->create();
                $res = $this->Model->where($where)->save($data);
                if($res === false){
                    $message .= $this->message;
                    if($this->Model->Error) $message = $this->Model->Error;
                    $this->returnAjaxError(['message'=>$message]);
                }
                break;
            case 'list':
                $message = '查询';
                $res = $this->Model->where($where)->order('id desc')/*->limit($this->page())*/->select();
                if($res === false){
                    $this->quickReturn(false,$message == 'Error' ? '错误类型！操作':$message.$this->message);
                }else{
                    $this->returnAjaxSuccess(['data'=>$res,'message'=>$message.$this->message.'成功！']);
                }
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

    //可选的操作
    private $actions = ['add','list','delete','remove','update','default'];
    public function _empty($method, $args){
        if(in_array(strtolower($method),$this->actions)) $this->CallAction($method);
        parent::_empty();
    }

    public function CallAction($method){
        $this->manage($method,I('id',null));
    }
}