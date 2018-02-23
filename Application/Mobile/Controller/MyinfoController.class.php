<?php

namespace Mobile\Controller;
/**
 * 个人信息控制器
 */
class MyinfoController extends CommonController
{
    /**
     * 获取个人数据
     * @param null $id
     */
    public function getUserInfo(){
        $this->quickReturn($this->Model->getUserInfo($this->userId),'获取');
    }

    /**
     * 更新个人信息
     */
    public function UpdateUserInfo(){
        if(!empty($_FILES['head'])){
            $fileName = $this->Model->uploadHead();
            if($fileName === null) $this->returnAjaxError(['message'=>$this->Model->Error]);
            $this->headimgurl = $fileName;
        }
        $this->Model->create();
        $this->id = $this->userId;
        $this->quickReturn($this->Model->relation(true)->save(),'修改');
    }
}