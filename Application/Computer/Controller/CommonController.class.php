<?php
namespace Computer\Controller;
use Common\Controller\CommonController as Controller;
/**
 * PC端公共控制器
 */
class CommonController extends Controller
{
    //PC端公共控制器
    public $ImagePathName;
    public $ImagePathName_thumb;
    //图片上传from-data
    public function uploadImage($image,$path,$thumb = false,$thumb_w = 150,$thumb_h = 150){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =      './'; // 设置附件上传根目录
        $upload->savePath  =      $path; // 设置附件上传目录    // 上传单个文件
        $upload->subName   =    array('date','Ymd');
        $info   =   $upload->uploadOne($image);
//        dump($info);
        if(!$info) {// 上传错误提示错误信息
            $this->Error = $upload->getError();
            return false;
        }else{// 上传成功 获取上传文件信息
            if($thumb){
                //生成缩略图
                $this->ImagePathName = $info['savepath'].$info['savename'];
                $image = new \Think\Image(\Think\Image::IMAGE_GD,$this->ImagePathName);
                $this->ImagePathName_thumb = dirname($this->ImagePathName).'/thumb_'.basename($this->ImagePathName);
                $image->thumb($thumb_w, $thumb_h)->save($this->ImagePathName_thumb);
            }
            return $this->ImagePathName;
        }

    }

}