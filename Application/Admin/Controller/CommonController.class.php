<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Page;

class CommonController extends Controller
{
    public function _initialize()
    {
        if(!session('userinfo')['id']){
            $this->redirect('Login/index');
        }
    }
    /**
     * TODO 基础分页的相同代码封装，使前台的代码更少
     * @param $count 要分页的总记录数
     * @param int $pagesize 每页查询条数
     * @return \Think\Page
     */
    static public function getpage($count, $pagesize = 10) {
        $p = new page($count,$pagesize);
        $p->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $p->setConfig('prev', '上');
        $p->setConfig('next', '下');
        $p->setConfig('last', '末');
        $p->setConfig('first', '首');
        $p->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $p->lastSuffix = false;//最后一页不显示为总页数
        return $p;
    }

    /**
     * @param $time
     * @return bool|string
     * 吧秒转换成对应的格式
     */
   static public function Sec2Time($time){
        if(is_numeric($time)){
            $value = array(
                "years" => 0, "days" => 0, "hours" => 0,
                "minutes" => 0, "seconds" => 0,
            );
            if($time >= 31556926){
                $value["years"] = floor($time/31556926);
                $time = ($time%31556926);
            }
            if($time >= 86400){
                $value["days"] = floor($time/86400);
                $time = ($time%86400);
            }
            if($time >= 3600){
                $value["hours"] = floor($time/3600);
                $time = ($time%3600);
            }
            if($time >= 60){
                $value["minutes"] = floor($time/60);
                $time = ($time%60);
            }
            $value["seconds"] = floor($time);
            $t=$value["years"] ."年". $value["days"] ."天"." ". $value["hours"] ."小时". $value["minutes"] ."分".$value["seconds"]."秒";
            Return $t;

        }else{
            return (bool) FALSE;
        }
    }

}
