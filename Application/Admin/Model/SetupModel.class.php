<?php
namespace Admin\Model;
use Think\Model;
class SetupModel extends Model {
    //查询单条
    public function find($id){
        $res = M('setup')->where(['id'=>$id])->find();
        return $res;
    }
    //增加，编辑
    public function doadd($id,$data){
        if(empty($id)){
            $res = M('setup')->add($data);
        }else{
            $res = M('setup')->where(['id'=>$id])->save($data);
        }
        return $res;
    }
    //删除单条数据
    public function remove($id){
        if(!empty($id)){
            $res = M('setup')->where(['id'=>$id])->delete();
            return $res;
        }
    }
}