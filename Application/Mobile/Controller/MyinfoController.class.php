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
        $this->Model->create();
        $this->id = $this->userId;
        //$this->id = url_decode($this->id);  //解密用户ID
        $this->quickReturn($this->Model->save(),'修改');
    }
}