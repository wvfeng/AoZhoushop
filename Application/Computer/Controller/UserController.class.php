<?php
namespace Computer\Controller;

/**
 * Class User
 * @package Computer\Controller
 */

use Mobile\Controller\MyinfoController;
class UserController extends MyinfoController
{
    const USER_NAME_EXISTING = 601;  //用户名已存在
    const USER_IPHONE_EXISTING = 602;//用户手机号已存在
    const USER_EMAIL_EXISTING = 603; //用户邮箱已存在
    const USER_NONEXISTENT = 605;    //用户不存在

    public $Message = [
        'USER_NAME_EXISTING'=>'用户名已存在!',
        'USER_IPHONE_EXISTING'=>'用户手机号已存在!',
        'USER_EMAIL_EXISTING'=>'用户邮箱已存在!',
        'USER_NONEXISTENT'=>'用户不存在!',
        'AVAILABLE'=>'信息可用!',
    ];

    //前端实现
    public function LogOut(){

    }

    //用户注册
    public function regUser(){
        //创建数据
        $data = $this->Model->create();
        $data['password'] = I('post.password',null);
        $data['rpassword'] = I('post.rpassword',null);
//        $data['User_detail'] = M('User_detail')->create();
        $res = $this->Model->checkdata($data);
        if($res !== true) $this->returnAjaxError(['message'=>'CODE_ARGUMENTS_ERROR','status'=>'CODE_ARGUMENTS_ERROR']);
        $res = $this->Model->is_uniqid($data['username'],$data['iphone'],$data['email']);
        if($res !== true) $this->returnAjaxError(['message'=>$this->Message[$res],'status'=>$res]);
        $data['password'] = md5($data['password']);
        $data['accessToken'] = uniqid();
        $data['status'] = 2;
        unset($data['rpassword']);
        $this->startTrans();
        $bool[] = $res = $this->Model->add($data);
        if($res){
            //接收分享人信息sdsd
            $shareid =I('post.usershare');
            $thisid = $res;
            //分享人存在则进行查询当前注册用户信息
            if(isset($shareid) && $shareid != ''){
               $bool[]=$this->recommend($shareid,$thisid);
            }
            if(!in_array(false,$bool)){
                $this->commit();
                $this->quickReturn($res !== false,'注册');
            }
        }else{
            $this->rollback();
            $this->returnAjaxError(['message'=>'用户注册失败']);
        }
    }

    /**
     * @param $sid
     * @param $zid
     * 处理用户分享成为下级的操作
     */
    public function recommend($sid,$zid)
    {
        $bool = $this->Model->where(['id'=>$zid])->save(['parent_id'=>$sid]);
        return $bool;
    }
    public function is_uniqid($username = null,$iphone = null,$email = null){

        $res = $this->Model->is_uniqid($username,$iphone,$email);
        if($res !== true){
            $this->returnAjaxError(['message'=>$this->Message[$res],'status'=>$res]);
        }else{
            $this->returnAjaxSuccess(['message'=>$this->Message['AVAILABLE']]);
        }
    }

    public function Test(){
        var_dump(A('Mobile/Myorder'));
    }


    //映射手机端接口
    //可选的操作
    private $actions = ['newuser'=>'newUser','login'=>'login','uppwd'=>'upPwd','ajaxprove'=>'ajaxProve'];
    public function _empty($method, $args){
        $method = strtolower($method);
        if(array_key_exists($method,$this->actions)){
            $method = $this->actions[$method];
            A('Mobile/Myorder')->$method();
        }else{
            parent::_empty();
        }
    }
}