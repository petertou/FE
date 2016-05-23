<?php
namespace Index\Controller;
use Think\Controller;

class CommonController extends Controller {
	//配置网站是否开启
	public function _initialize(){
		if(!C('WEB_ON')){
			E('您访问的页面不存在');
		}

		//实现自动登录
		// p($_SESSION['uid']);die;
		if(isset($_COOKIE['uid']) && !isset($_SESSION['uid'])){
			$value = explode('|',encrytion($_COOKIE['uid']));
			if($value[1] == get_client_ip()){
				session('uid',$value[0]);
				session('user',$value[2]);
			}
		}
	 }

	//验证码
	public function Verify(){
		$Verify = new \Think\Verify(); 
		$Verify->entry();
	}

	//异步验证用户名
	public function AjaxUser(){
		if(!IS_AJAX) $this->error('您访问的页面不存在');
		$user = I('post.username');
		$result = M('user')->where(array('user'=>$user))->find();
		if($result){
			echo 0;
		}else{
			echo 1;
		}
	}

	public function AjaxNick(){
		if(!IS_AJAX) $this->error('您访问的页面不存在');
		$nick = I('post.nickname');
		$result = M('user')->where(array('nickname'=>$nick))->find();
		if($result){
			echo 0;
		}else{
			echo 1;
		}
	}

	//异步验证验证码
	public function AjaxCode(){
		if(!IS_AJAX) $this->error('您访问的页面不存在');
		$code = I('post.verify');
		$result = check_verify($code);
		if($result){
			echo 1;
		}else{
			echo 0;
		}
	}

	//注册过来的数据
	public function Register(){
		if(!IS_POST) $this->error('您访问的页面不存在');
		$db =D('User');

		if(!$db->create()){
			$this->error($db->getError());
		}

		$username = $db->user;

		if(!$uid = $db->add()){
			$this->error("注册失败,请重试");
		}

		session('uid',$uid);
		session('uname',$username);
		$this->success('注册成功',U('Index/index/index'));

	}


	// 异步验证登录表单
	public function AjaxLogin(){
		if(!IS_POST) $this->error('您访问的页面不存在');
		$username = I('post.username');
		$pwd = I('post.pwd','','md5');
		$result = M('user')->where(array('account'=>$username))->getField('passwd');
		if(!$result || $result != $pwd){
			echo 0;
		}else{
			echo 1;
		}

	}

	// 用户登录
	public function Login(){
		if(!IS_POST) $this->error("您访问的页面不存在");
		$pwd = I('post.pwd','','md5');
		$user = I('post.account');
		$field = 'uid,user,nickname,logintime,lock,passwd';
		$where = array('user'=>$user);
		$user = M('user')->field($field)->where($where)->find();

		if(!$user || $user['passwd'] != $pwd){
			$this->error('用户名或者密码不存在');
		}

		if($user['lock']){
			$this->error('对不起，该用户已经被锁定');
		}

		if(isset($_POST['auto'])){
			$key = $user['uid'] .'|'.get_client_ip() .'|'.$user['user'];
			$value = encrytion($key,1);
			@setcookie('uid',$value,C('login_lifetime'),'/');
		}

		$today = strtotime(date('Y-m-d'));//获取当天的时间戳

		if($user['logintime']<$today){
			M('user')->where(array('uid'=>$user['uid']))->setInc('exp',C('LV_LOGIN'));
		}

		M('user')->where(array('uid'=>$user['uid']))->save(array('logintime'=>time()));

		session('uid',$user['uid']);
		session('user',$user['user']);
		redirect($_SERVER["HTTP_REFERER"]);
	}

	public function logout(){
		session_unset();
		session_destroy();
		$this->success('退出成功',U('index/index'));
	}









}