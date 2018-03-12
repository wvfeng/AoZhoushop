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
        //创建数据
        $data = $this->Model->create();
        $data['User_detail'] = M('User_detail')->create();
        //上传头像
        if(!empty($_FILES['head'])){
            $fileName = $this->Model->uploadHead($this->Model->where(['id'=>$this->userId])->relation(true)->find()['headimgurl']);
            if($fileName === null) $this->returnAjaxError(['message'=>$this->Model->Error]);
            $data['User_detail']['headimgurl'] = $fileName;
        }
        $this->returnAjaxError(['data'=>$_POST]);
        $res = $this->Model->where(['id'=>$this->userId])->relation(true)->save($data);
        if($res === false){
            //修改失败，资源回收
            file_exists($this->Model->Header)        &&   unlink($this->Model->Header);
            file_exists($this->Model->Header_thumb)  &&   unlink($this->Model->Header_thumb);
        }else{
            //修改成功，回收旧头像
            file_exists($this->Model->Header_odl)        &&   unlink($this->Model->Header_odl);
            file_exists($this->Model->Header_thumb_odl)  &&   unlink($this->Model->Header_thumb_odl);
        }
        $this->quickReturn($res !== false,'修改');
    }
}