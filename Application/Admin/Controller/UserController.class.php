<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
    protected $vlist;
    public function index(){
        $table = M('user');
        if(I('clsea')==1){
            $map = null;
            $map = "nickname='".I('clvar')."' OR name='".I('clvar')."' OR iphone='".I('clvar')."'";
        }
        if(I('clsea')==2){
            $map = null;
            $map = ['grade_id'=>I('clsea_grade')];
        }
        if(I('clip_type')){
            $map = null;
            $map = ['clip_type'=>I('clip_type')];
        }
        $count = $table->where($map)->count();
        $Page = new \Think\Page($count,25);
        foreach($map as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        if(I('order')=='desc'){
            $order = 'surplus_money desc';
        }else if(I('order')=='asc'){
            $order = 'surplus_money asc';
        }else{
            $order = 'id desc';
        }
        $show = $Page->show();
        $list = $table->where($map)->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();
        if(!empty(count($map))){
            session(array('name'=>'excelc','expire'=>3600));
            session('excelc',$map);
        }else{
            session('excelc',null);
        }
        //导出EXCEL
        if(I('excel')==1){
            $this->vlist = $table->where(session('excelc'))->select();
            $this->getexcel();
        }
        $count_user['yi'] = $table->where(['clip_type'=>1])->count();
        $count_user['er'] = $table->where(['clip_type'=>2])->count();
        $count_user['san'] = $table->where(['clip_type'=>0])->count();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->assign('order',I('order'));
        $this->assign('count_user',$count_user);
        $this->assign('clvar',I('clvar'));
        $this->assign('clsea_grade',I('clsea_grade'));
        $this->assign('clip_type',I('clip_type'));
        $this->display();
    }
    public function duihuan(){
        $table = M('order');
        if(I('clsea')==1){
            $map = null;
            $map = "name='".I('clvar')."' OR iphone='".I('clvar')."'";
            $shop_id = M('shop')->where(['tit'=>I('clvar')])->getField('id');
            if(!empty($shop_id)){
                $map = null;
                $map['shop_id'] = array('in',$shop_id);
            }
        }
        if(I('clvar_date')){
            $map = null;
            $map['date'] = array(array('EGT',I('clvar_date')),array('ELT',I('clvar_date_er')),'AND');
        }
        $count = $table->where($map)->where(['user_id'=>I('id'),'classify'=>1])->count();
        $Page = new \Think\Page($count,25);
        $show = $Page->show();
        $list = $table->where($map)->where(['user_id'=>I('id'),'classify'=>1])
        ->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => &$v) {
            $v['shop_name'] = M('shop')->where(['id'=>$v['shop_id']])->getField('tit');
        }
        $nickname = M('user')->where(['id'=>I('id')])->getField('nickname');
        $leiji['money'] = $table->where(['user_id'=>I('id'),'classify'=>1])->sum('money');
        $leiji['integral'] = $table->where(['user_id'=>I('id'),'classify'=>1])->sum('integral');
        $this->assign('leiji',$leiji);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->assign('id',I('id'));
        $this->assign('nickname',$nickname);
        $this->display();
    }
    public function tuijian(){
        file_put_contents("./Public/tuijianren.txt","");
        //一级
        $tuijian_date = M('referees')->where(['send_user_id'=>I('id')])->select();
        again($tuijian_date);
        $str_tuijian = file_get_contents("./Public/tuijianren.txt");
        $list = explode('|x|',$str_tuijian);
        foreach ($list as $key => &$v) {
            if(empty($v)){
                unset($list[$key]);
            }
            $v = unserialize($v);
        }
        foreach ($list as $key => &$v) {
            $v['user'] = M('user')->where(['id'=>$v['get_user_id']])->find();
            $v['user']['lev_name'] = M('grade')->where(['id'=>$v['user']['grade_id']])->getField('lev_name');
            $v['user']['up_name'] = M('user')->where(['id'=>$v['send_user_id']])->getField('nickname');
        }
        $leiji = count($list);
        $nickname = M('user')->where(['id'=>I('id')])->getField('nickname');
        $this->assign('leiji',$leiji);
        $this->assign('nickname',$nickname);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    public function yongjin(){
        $table = M('commission');
        $map = ['upper_user_id'=>I('id')];
        $count = $table->where($map)->count();
        $Page = new \Think\Page($count,25);
        $show = $Page->show();
        $list = $table->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach ($list as $key => &$v) {
            $v['lower_user_name'] = M('user')->where(['id'=>$v['lower_user_id']])->getField('nickname');
        }
        $nickname = M('user')->where(['id'=>I('id')])->getField('nickname');
        $leiji = $table->where($map)->sum('money');
        $this->assign('nickname',$nickname);
        $this->assign('leiji',$leiji);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    public function tixian(){
        $table = M('cash');
        $map = ['user_id'=>I('id')];
        $count = $table->where($map)->count();
        $Page = new \Think\Page($count,25);
        $show = $Page->show();
        $list = $table->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $nickname = M('user')->where(['id'=>I('id')])->getField('nickname');
        $leiji = $table->where($map)->sum('cash_money');
        $this->assign('nickname',$nickname);
        $this->assign('leiji',$leiji);
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //导出会员
    public function getexcel(){
            Vendor('Classes.PHPExcel');
            $objPHPExcel=new \PHPExcel();
            $j=2;
            $n=1;
            //$objSheet = $objPHPExcel->createSheet();  
            $objSheet=$objPHPExcel->getActiveSheet();//获取当前活动sheet
            $objSheet->setCellValue('A1','昵称')->setCellValue('B1','姓名')->setCellValue('C1','手机号')->setCellValue('D1','收货地址')
            ->setCellValue('E1','购卡类型')->setCellValue('F1','级别')->setCellValue('G1','余额')->setCellValue('H1','积分');
            $list = $this->vlist;
            foreach ($list as $key => &$v) {
                $v['lev_name'] = M('grade')->where(['id'=>$v['grade_id']])->getField('lev_name');
                if($v['clip_type']==1){
                    $v['clip_type_name'] = '会员卡一';
                }else{
                    $v['clip_type_name'] = '会员卡二';
                }
            }
            foreach($list as $k=>$val){
                $objSheet->setCellValue("A".$j,$val['nickname'])->setCellValue("B".$j,$val['name'])->setCellValue("C".$j,$val['iphone'])
                ->setCellValue("D".$j,$val['address'])->setCellValue("E".$j,$val['clip_type_name'])
                ->setCellValue("F".$j,$val['lev_name'])
                ->setCellValue("G".$j,$val['surplus_money'])->setCellValue("H".$j,$val['surplus_int']);
                $j++;$n++;
                //数据大于50，换页
                if($n>50){
                    $n=1;
                    $j=2;
                    $objSheet = $objPHPExcel->createSheet();    
                    $objSheet->setCellValue('A1','昵称')->setCellValue('B1','姓名')->setCellValue('C1','手机号')->setCellValue('D1','收货地址')
            ->setCellValue('E1','购卡类型')->setCellValue('F1','级别')->setCellValue('G1','余额')->setCellValue('H1','积分');
                }
            }
            $objWriter=\PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');//生成excel文件
            if(!is_dir("./Public/upexcel/".date('Y-m-d'))){
                mkdir("./Public/upexcel/".date('Y-m-d'));
            }
            $second = date("His");
            $objWriter->save("./Public/upexcel/".date('Y-m-d')."/".$second.".xls");//保存文件
            $filepath = "./Public/upexcel/".date('Y-m-d')."/".$second.".xls";
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($filepath));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            ob_clean();
            flush();
            readfile($filepath);
            exit;
    }
}