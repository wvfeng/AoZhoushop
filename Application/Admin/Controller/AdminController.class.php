<?php
namespace Admin\Controller;

class AdminController extends CommonController
{
    public function index()
    {
        $Model = M('admin');
        $this->assign('list', $Model->select());
        $this->display();
    }

    public function add()
    {
        $this->display();
    }

    public function insert()
    {   
        if(I('password')!=I('repassword')){
            $this->error('添加失败');
        }
        $data['name'] = I('name');
        $data['password'] = md5(I('password'));
        $data['status'] = I('status');
        $Model = M('admin');

        $res = $Model->add($data);
        if($res!==false){
            $this->success('添加成功', U('Admin/index'));
        }else{
            $this->error('添加失败');
        }

    }

    public function edit()
    {
        $Model = M('admin');
        $this->assign($Model->find(I('get.id')));
        $this->display();

    }

    public function save()
    {
        if (empty($_POST['password'])) {
            unset($_POST['password']);
        }
        $Model = M('admin');
        $data['name'] = I('name');
        $data['password'] = md5(I('password'));
        $data['status'] = I('status');
        $res = $Model->where(['id'=>I('id')])->save($data);
        if($res!==false){
            $this->success('修改成功', U('Admin/index'));
        }else{
            $this->error('没有修改');
        }
    }

    public function del()
    {
        M('admin')->where(array('id' => I('post.id')))->delete();
        $this->ajaxReturn(1);
    }

    public function status()
    {
        $data['status'] = I('post.status');
        M('admin')->where(array('id' => I('post.id')))->save($data) ? $this->success('修改成功', U('Admin/index')) : $this->error('修改失败');
    }
}
