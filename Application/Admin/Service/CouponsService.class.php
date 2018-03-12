<?php
namespace Admin\Service;
use Admin\Controller\CommonController;
use Admin\Model\UserModel;


class CouponsService extends CommonController
{
    /**
     * @return array
     * 查询用户数据
     */
    static public function SendUserlist()
    {
        $model =  new UserModel();
        $count = $model->count();
        $p = self::getpage($count,5); //分页
        $data = $model->limit($p->firstRow, $p->listRows)->select();// 赋值数据集
        $page =  $p->show();// 赋值分页输出
        return [
            'data'=>$data,
            'page'=>$page
        ];
    }

    /**
     * @param $param
     * @return bool
     * 发送多个优惠卷
     */
    static public function SendUser($param)
    {
        $cid = $param['cid'];
        $model = M('coupons');
        $old = self::ifdata($cid);
        if($old){
            $param['data'] = $old.','.$param['data'];
        }
        $newstr = substr($param['data'],0,strlen($param['data'])-1);
        return $model->where(['id'=>$cid])->save(['userid'=>$newstr]);
    }

    /**
     * @param $cid
     * @return bool|mixed
     * 判断优惠卷是不是已经有人了
     */
    static public function ifdata($cid)
    {
        $model = M('coupons');
        $bool = $model->where(['id'=>$cid])->getField('userid');
        if($bool){
            return $bool;
        }else{
            return false;
        }
    }

    /**
     * @param $cid
     * @return bool
     * 发送给所有用户的处理方法
     */
    static public function SendUserAll($cid)
    {
        $user = new UserModel();
        $coup = M('coupons');
        $userid = $user->where(['status'=>'正常'])->Field('id')->select();
        $str = '';
        foreach ($userid as $key=>$vs)
        {
            $str.=$vs['id'].',';
        }
        $str = substr($str,0,strlen($str)-1);
        $old = self::ifdata($cid);
        if($old){
            $str = $old.','.$str;
        }
        return $coup->where(['id'=>$cid])->save(['userid'=>$str]);
    }
}