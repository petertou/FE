<?php
namespace Index\Controller;
use Think\Controller;

class AskController extends CommonController{

	public function index(){
		// print_const();die;
		$this->cate = M('category')->where(array('pid'=>0))->order(array('cid'=>'asc'))->select();
		if(isset($_SESSION['uid']) && isset($_SESSION['user'])){
			$this->point= M('user')->where(array('uid'=>$_SESSION['uid']))->getField('point');
		}
		$this->display();
	}


	public function get_cate(){
		if(!IS_AJAX) $this->error("您访问的页面不存在");
		$cid= I('post.pid',0,'intval');

		$result = M('category')->where(array('pid'=>$cid))->order(array('cid'=>'asc'))->select();
		if($result){
			echo json_encode($result);
		}else{
			echo 0;
		}
	}


	public function send(){
		if(!IS_POST) $this->error('对不起，您访问的页面不存在');
		// p($_POST);die;
		$data = array(
			'content' => I('post.content'),
			'reward' => I('post.reward'),
			'atime' =>time(),
			'uid' => $_SESSION['uid'],
			'cid' => I('post.cid',0,'intval')
		);

		if(M('ask')->add($data)){
			$where = array('uid'=>$_SESSION['uid']);
			$db = M('user');
			$db->where($where)->setInc('exp',C('LV_ASK'));
			$db->where($where)->setInc('ask');
			redirect(U('Member/index',array('uid'=>session('uid'))));
		}else{
			$this->error('发布失败，请重试......');
		}
	}
}