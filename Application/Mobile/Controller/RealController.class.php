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
        if (!$realname->create()){
            $data['data']=['res'=>'数据不完整'];
            $this->returnAjaxError($data);
        }else{
            $res = $realname->add(I(''));
            if(!empty($res)){
                $data['data']=['res'=>'增加数据成功'];
                $this->returnAjaxSuccess($data);
            }
        }
    }
    //实名认证证件图片上传
    public function uploadrealnameimg(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     13145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './Public/zhengjian/'; // 设置附件上传根目录
        $upload->autoSub = true;
        $upload->subName = array('date','Ymd');
        // 上传单个文件 
        $info   =   $upload->uploadOne($_FILES['file']);
        if(!$info) {// 上传错误提示错误信息
            $data['data']=['res'=>$upload->getError()];
            $this->returnAjaxError($data);
        }else{// 上传成功 获取上传文件信息
            $data['data'] = ['path'=>$info['savepath'].$info['savename']];
            $this->returnAjaxSuccess($data);
        }
    }
}