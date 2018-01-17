<?php

namespace Mobile\Controller;
/**
 * 个人信息控制器
 */
class MyinfoController extends CommonController
{
    //获取个人数据
    public function getUserInfo($id = null){
        if(empty($id)) $this->returnAjaxError(['message'=>'用户ID不能为空！']);
        $this->quickReturn($this->Model->getUserInfo($id));
    }

    public function UpdateUserInfo(){
        $this->Model->create();
        //$this->id = url_decode($this->id);  //解密用户ID
        $this->quickReturn($this->Model->save(),'修改');
    }

    public function Collect($id =null,$type = null,$action = null){
        if(empty($id) || empty($type)) $this->returnAjaxError(['message'=>'ID和类型不能为空！']);
        $model = D('Common/Collect');
        if($type == 'list'){
            $this->quickReturn($this->Model->where(['u_id'=>$id])->limit($this->page())->select());
        }
    }
}