<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        return $this->show('<center><h1>欢迎来到澳洲商城！</h1></center>');
    }
}