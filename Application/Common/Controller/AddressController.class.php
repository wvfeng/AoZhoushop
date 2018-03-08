<?php
namespace Common\Controller;

class AddressController extends CommonController
{
    public $message = '收货地址';
    private $where = [];

    public function manage($type = 'list',$id = null){
        $this->where['user_id'] = $this->userId;
        if($type == 'getdefault'){
            $this->where['sdefault'] = 1;
        }else{
            if(is_numeric($id)) $this->where['id'] = $id;
        }
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
                $res = $this->Model->where($this->where)->delete();
                $res = $res === false ? $res:true;
                break;
            case 'delete':
                $this->manage('remove',$id);
                break;
            case 'update':
                $message = '更新';
                $data = $this->Model->create();
                $res = $this->Model->where($this->where)->save($data);
                if($res === false){
                    $message .= $this->message;
                    if($this->Model->Error) $message = $this->Model->Error;
                    $this->returnAjaxError(['message'=>$message]);
                }
                break;
            case 'list':
                $message = '查询';
                $res = $this->Model->where($this->where)->order('id desc')->select();
                if(empty($res) && isset($this->where['sdefault'])){
                    unset($this->where['sdefault']);
                    $res = $this->Model->where($this->where)->order('id desc')->limit(1)->select();
                }
                if($res === false){
                    $this->quickReturn(false,$message == 'Error' ? '错误类型！操作':$message.$this->message);
                }else{
                    $this->returnAjaxSuccess(['data'=>$res,'message'=>$message.$this->message.'成功！','code'=>empty($res)?0:1]);
                }
                break;
            case 'getdefault':
                $this->manage($type = 'list',$id);
                break;
            case 'default':
                $message = '设置默认地址';
                $res = $this->Model->setDefault($this->where);
                break;
            default :
                $message = 'Error';
                $res = null;
        }
        $this->quickReturn($res,$message == 'Error' ? '错误类型！操作':$message.$this->message);
    }

    //可选的操作
    private $actions = ['add','list','delete','remove','update','default','getdefault'];
    public function _empty($method, $args){
        if(in_array(strtolower($method),$this->actions)) $this->CallAction($method);
        parent::_empty();
    }

    public function CallAction($method){
        $this->manage($method,I('id',null));
    }
}