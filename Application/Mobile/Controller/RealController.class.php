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
        if(!I('userId')){
            $data['data']=['res'=>'数据不完整'];
            $this->returnAjaxError($data);
        }
        if($_FILES['zheng']==false||$_FILES['fan']==false){
            $data['data']=['res'=>'数据不完整'];
            $this->returnAjaxError($data);
        }
        $addData = I('');
        $addData['user_id'] = url_decode(I('userId'));
        $addData['zheng'] = $this->uploadrealnameimg($_FILES['zheng']);
        $addData['fan'] = $this->uploadrealnameimg($_FILES['fan']);
        if (!$realname->create()){
            $data['data']=['res'=>'数据不完整'];
            $this->returnAjaxError($data);
        }else{
            $isthere = M('realname')->where(['user_id'=>url_decode(I('userId'))])->count();
            if(empty($isthere)){
                $res = $realname->add($addData);
            }else{
                $res = $realname->where(['user_id'=>url_decode(I('userId')),'type'=>0])->save($addData);
            }
            if(!empty($res)){
                $data['data']=['res'=>'增加/编辑数据成功'];
                $this->returnAjaxSuccess($data);
            }else{
                $data['data']=['res'=>'无操作'];
                $this->returnAjaxError($data);
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
            return $info['savepath'].$info['savename'];
        }
    }
    //查询实名认证
    public function getRealname(){
        $data['data'] = M('realname')->where(['user_id'=>url_decode(I('userId'))])->find();
        if(empty($data['data'])){
            $data['data']['type'] = 2;
        }
        $this->returnAjaxSuccess($data);
    }
}