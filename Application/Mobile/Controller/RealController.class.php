<?php
namespace Mobile\Controller;
/**
 * 实名认证
 */
class RealController extends CommonController
{   
    //添加数组
    public function realnameadd(){
        $realname = D('Realname');
        if(!I('user_id')){
            $data['data']=['res'=>'数据不完整'];
            $this->returnAjaxError($data);
        }
        if(!I('zheng')||!I('fan')){
            $data['data']=['res'=>'数据不完整'];
            $this->returnAjaxError($data);
        }
        $addData = I('');
        $addData['zheng'] = $this->uploadrealnameimg($_FILES['zheng']);
        $addData['fan'] = $this->uploadrealnameimg($_FILES['fan']);
        if (!$realname->create()){
            $data['data']=['res'=>'数据不完整'];
            $this->returnAjaxError($data);
        }else{
            $res = $realname->add($addData);
            if(!empty($res)){
                $data['data']=['res'=>'增加数据成功'];
                $this->returnAjaxSuccess($data);
            }
        }
    }
    //实名认证证件图片上传
    public function uploadrealnameimg($file){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     13145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Public/zhengjian/'; // 设置附件上传根目录
        $upload->autoSub = true;
        $upload->subName = array('date','Ymd');
        // 上传单个文件 
        $info   =   $upload->uploadOne($file);
        if(!$info) {// 上传错误提示错误信息
            return ['res'=>$upload->getError()];
        }else{// 上传成功 获取上传文件信息
            return ['path'=>$info['savepath'].$info['savename']];
        }
    }
}