<?php
namespace Admin\Model;
use Think\Model;
class ShopModel extends Model {
    //查询单条
    public function find($id){
        $res = M('shop')->where(['id'=>$id])->find();
        return $res;
    }
    //增加，编辑
    public function doadd($id,$data){
        if(empty($id)){
            $res = M('shop')->add($data);
        }else{
            $res = M('shop')->where(['id'=>$id])->save($data);
        }
        return $res;
    }
    //删除单条数据
    public function remove($id){
        if(!empty($id)){
            $res = M('shop')->where(['id'=>$id])->delete();
            return $res;
        }
    }
}