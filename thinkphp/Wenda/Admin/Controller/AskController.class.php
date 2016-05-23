<?php
namespace Admin\Controller;
use Think\Controller;

class AskController extends CommonController {
	//所有问题
	public function index(){
		$db = M('ask');
		$count = $db->count();
		$page = new \Think\Page($count,5);
		$limit = $page->firstRow.','.$page->listRows;
		$result = $db->limit($limit)->select();
		$pages = $page->show();

		$this->result = $result;
		$this->page = $pages;
		$this->display();
	}
	//待解决问题
	public function wait(){
		$db = M('ask');
		$count = $db->where(array('slove'=>0))->count();
		$page = new \Think\Page($count,5);
		$limit = $page->firstRow.','.$page->listRows;
		$result = $db->where(array('slove'=>0))->limit($limit)->select();
		$pages = $page->show();
		$this->result = $result;
		$this->page = $pages;
		$this->display('index');
	}
	//已解决问题
	public function slove(){
		$db = M('ask');
		$count = $db->where(array('slove'=>1))->count();
		$page = new \Think\Page($count,5);
		$limit = $page->firstRow.','.$page->listRows;
		$result = $db->where(array('slove'=>1))->limit($limit)->select();
		$pages = $page->show();
		$this->result = $result;
		$this->page = $pages;
		$this->display('index');
	}

	public function zero(){
		$db = M('ask');
		$count = $db->count();
		$page = new \Think\Page($count,5);
		$limit = $page->firstRow.','.$page->listRows;
		$result = $db->where(array('answer'=>0))->limit($limit)->select();
		$pages = $page->show();
		$this->result = $result;
		$this->page = $pages;
		$this->display('index');
	}


	//删除所有问题
	public function del(){
		$aid = I('get.aid',0,'intval');
		$db = M('user');
		$info = M('ask')->where(array('aid'=>$aid))->Field('uid,slove')->find();
		if(D('AskRelation')->relation(true)->delete($aid)){
			// 如果提问的问题有已解决的
			if($info['slove']){
				$where = array('aid'=>$aid,'adopt'=>1);
				$uid = M('answer')>where($where)->getField('uid');
				$db->where(array('uid'=>$uid))->setDec('point',C('DEL_ACCEPT_ANSWER'));
				$db->where(array('uid'=>$info['uid']))->setDec('point',C('DEL_ACCEPT_ASK'));
			}else{
				M('user')->where(array('uid'=>$info['uid']))->setDec('point',C('DEL_ASK'));
			}

			$this->success('删除成功',U('index'));
		}else{
			$this->error('删除失败，请重试......');
		}	
	}
}