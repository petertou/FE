<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
       $this->display();
    }


    public function copy(){
    	$this->display();
    }

    public function logout(){
    	session_unset();
    	session_destroy();
    	$this->success("退出成功",U('admin/login/index'));
    }
}