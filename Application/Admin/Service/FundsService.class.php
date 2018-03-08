<?php
namespace Admin\Service;
use Admin\Controller\CommonController;
use Common\Model\GradeModel;
use Common\Model\RebateModel;

class FundsService extends CommonController
{
    /**
     * @return mixed
     * 返回数据
     */
    static public function FundsList()
    {
        //会员信息
        $data = self::SelectData();
        return $data;
    }

    /**
     * @return mixed
     * 查询会员信息
     */
    static public function SelectData()
    {
        $model = new GradeModel();
        $count = $model->count();
        $p = self::getpage($count,5); //分页
        $data = $model->order('grade_ctime desc')->limit($p->firstRow, $p->listRows)->select();// 赋值数据集
        $page =  $p->show();// 赋值分页输出
        return [
            'data'=>$data,
            'page'=>$page
        ];
    }

    /**
     * @param $id
     * @return mixed
     * 获取要编辑的数据
     */
    static public function Fundsedit($id)
    {
        $model = new GradeModel();
        $data = $model->where(['grade_id'=>$id])->find();
        return $data;
    }

    /**
     * @param $param
     * @return bool
     * 编辑信息处理方法
     */
    static public function FundsSave($param)
    {
        if($param['grade_name'] == ''){
            return false;
        }
        $model = new GradeModel();
        $grade_id = $param['grade_id'];
        unset($param['grade_id']);
        $param['grade_ctime'] = date('Y-m-d H:i:s',time());
        $bool = $model->where(['grade_id'=>$grade_id])->save($param);
        return $bool;
    }

    /**
     * @return mixed
     * 会员等级查询
     */
    static public function discount()
    {
        $model = new GradeModel();
        $data = $model->select();
        return $data;
    }

    /**
     * 代理折扣查询
     */
    static public function selectRebate($param)
    {
       $model = new RebateModel();
       $data = $model->where($param)->find();
       return $data;
    }

    /**
     * @param $param
     * @return bool
     * 代理折扣设置
     */
    static public function SaveRebate($param)
    {
       $model = new RebateModel();
       $rebate_this_id = $param['rebate_this_id'];
       $rebate_cover_id = $param['rebate_cover_id'];
       unset($param['rebate_cover_id']);
       unset($param['rebate_this_id']);
       return $model->where(['rebate_this_id'=>$rebate_this_id,'rebate_cover_id'=>$rebate_cover_id])->save($param);
    }
}
