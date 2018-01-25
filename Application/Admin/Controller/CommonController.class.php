<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{
    public function _initialize()
    {
        if(!session('userinfo')['id']){
            $this->redirect('Login/index');
        }
    }
}
