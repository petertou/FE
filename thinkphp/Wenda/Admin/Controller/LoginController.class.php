<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {
	/**
	 * [index 默认首页]
	 * @return [type] [description]
	 */
	public function index(){
		$this->display();
	}

	/**
	 * [verify 获取验证码]
	 * @return [type] [description]
	 */
	public function verify(){
		$config = array(
			'fontSize'=>18,
			'imageW'=>120,
			'imageH'=>50,
			'length'=>1,
			'useNoise'=>false
			);
		$Verify = new \Think\Verify($config); 
		$Verify->entry();
	}

	/**
	 * [login 表单登录]
	 * @return [type] [description]
	 */
	public function login(){
		if(!IS_POST) $this->error("您访问的页面不存在");
		$code = I('post.code');
		if(!check_verify($code)){
			$this->error("验证码有误");
		}
		$user = I('post.username');
		$pass = I('post.password','','md5');
		$where = array('account'=>$user);
		$result = M('admin')->where($where)->find();

		if(!$result && $pass != $result['password']){
			$this->error("您的用户名或者密码错误");
		}

		if($result['lock'] == 1 ) $this->error('您现在没有权利登录后台');
		$ip = get_client_ip();
		$data = array(
			'logintime'=>time(),
			'loginip'=>$ip
			);
		M('admin')->save($data);
		session('uid',$result['id']);
		session('user',$result['account']);
		$this->success('登录成功',U('admin/index/index'));
	}

	public function checkAccount(){
		if(!IS_AJAX) $this->error("您访问的页面不存在");
		$db = M('admin');
		$user = I('post.username');
		$where = array('account'=>$user);
		$result = $db->where($where)->find();
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}


	public function checkPwd(){
		if(!IS_AJAX) $this->error("您访问的页面不存在");
		$db = M('admin');
		$pass = I('post.password','','md5');
		$user = I('post.username');
		$where = array('account'=>$user);
		$result = $db->where($where)->find();
		if($pass != $result['password']){
			echo 0;
		}else{
			echo 1;
		}
	}

	public function checkVerify(){
		if(!IS_AJAX) $this->error("您访问的页面不存在");
		$code = I('post.code');
		$result = check_verify($code);
		if($result){
			echo 1;
		}else{
			echo 0;
		}

	}


}