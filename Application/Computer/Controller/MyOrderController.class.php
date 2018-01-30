<?php
namespace Computer\Controller;
use Common\Controller\CommonController as Controller;
/**
 * 订单多种状态
 */
class MyOrderController extends Controller
{
	/**
	 * [type] [订单的各种状态]
	 */
   public function orderType(){
     $db = M('order');
      I('get.id')?$where['id'] = I('get.id'):"";
      $where['user_id'] = session('user_id');
     $con = $db->where($where)->field('shop_id,num')->select();
     foreach ($con as $key => $value) {
         // 把商品id数量炸开
         $shop_id = explode("|*|",$con[$key]['shop_id']);
         $num = explode("|*|",$con[$key]['num']);
         $wheres['id'] = array('in',implode($shop_id,","));
         $data[$key] = M('shop')->where($wheres)->select();
         foreach ($data[$key] as $k => $v) {
             // 订单数量填充入数组
             $data[$key][$k]['number'] = $num[$k];
         }
     }
         // $shop_id = explode("|*|",$con[0]['shop_id']);
         // $wheres['id'] = array('in',implode($shop_id,","));
         // $data = M('shop')->where($wheres)->select();
     if($data){
     	     $this->quickReturn($data);
     	 }else{
     	 	$this->returnAjaxError($data);
     	 }     
    }
        /**
     * 文件上传入口
     * string id
     */
    public function userSay(){
        // 用户评星级
        $where['star'] = I('post.star');
        $where['text'] = I('post.text');
        $where['user_id'] = session('user_id');
        $where['shop_id'] = I('post.shop_id');
        $where['type'] = I('post.type');
        // 图片接口
        $file = $_FILES;
        // var_dump($file);die();
        $type = "say";
        $table = "evaluation";
        $tables = 'order';
        $this->picture($type,$file,$where,$table,$tables);
    }
    /**
     * [picture description]
     * @param  string    $type  [保存路径]
     * @param  [array]   $file  [图片]
     * @param  [string]  $where [文字参数]
     * @param  [data]    $table [存入表中]
     * @return [json]    $data  [处理结果]
     */
    
    public function picture($type="uploads",$file,$where,$table,$tables){
    // 图片上传接口
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     53145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','tmp');// 设置附件上传类型
                $upload->rootPath  =     './Public/'; // 设置附件上传根目录
                $upload->savePath  =     $type."/"; // 设置附件上传（子）目录
                $upload->subName   =     '';
                          //缩略图
                $upload->uploadReplace     = true; //是否存在同名文件是否覆盖  
                $upload->autoSub           = true; //是否使用子目录保存图片  
                $upload->thumbRemoveOrigin = false; //上传图片后删除原图片 
        foreach ($file as $key => $val) {
            if (!empty($file[$key]['tmp_name'])) {
                $info = $upload->uploadOne($file[$key]);
                if ($info) {
                     $w = "/conf/".$info['savename'];
                     $img[$key] = $w;
                }

            }
        }    
        $where['img'] = implode($img, "|*|");
        $db = M($table);
        $data['data'] = $db->add($where);
         if(!empty($data['data'])){
            // 如果评论已提交更改订单状态
             if($tables){
               $dbs = M($tables);
               $con = $dbs->where(['id'=>$where['shop_id']])->save(['type'=>'已评价']);
               $con?$this->quickReturn($data):$this->returnAjaxError($data); 
             }
        }else{
             $this->returnAjaxError($data); 
        }
    }
}