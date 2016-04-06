<?php
namespace Admin\Controller;
use Think\Controller;

class AnswerController extends CommonController {

	public function index(){
		$filter = isset($_GET['filter']) ? $_GET['filter']:0;

		if($filter){
			$where['adopt'] = $filter == 1 ? 0 : 1 ;
		}

		$db = M('answer');

		if($filter == 0){
			$count = $db->count();
		}else{
			$count = $db->where($where)->count();
		}

		$page = new \Think\Page($count,5);
		$limit = $page->firstRow.','.$page->listRows;
		$result = $db->where($where)->limit($limit)->select();
		$pages = $page->show();
		$this->result = $result;
		$this->page = $pages;
		$this->display();
	}

	//unslove
	// public function unslove(){
	// 	$db = M('answer');
	// 	$count = $db->where(array('adopt'=>0))->count();
	// 	$page = new \Think\Page($count,5);
	// 	$limit = $page->firstRow.','.$page->listRows;
	// 	$result = $db->where(array('adopt'=>0))->limit($limit)->select();
	// 	$pages = $page->show();
	// 	$this->result = $result;
	// 	$this->page = $pages;
	// 	$this->display('index');
	// }

	//slove
	// public function slove(){
	// 	$db = M('answer');
	// 	$count = $db->where(array('adopt'=>1))->count();
	// 	$page = new \Think\Page($count,5);
	// 	$limit = $page->firstRow.','.$page->listRows;
	// 	$result = $db->where(array('adopt'=>1))->limit($limit)->select();
	// 	$pages = $page->show();
	// 	$this->result = $result;
	// 	$this->page = $pages;
	// 	$this->display('index');
	// }


	//删除
	public function del(){
		$sid = I('get.sid',0,'intval');
		$uid = I('get.uid',0,'intval');
		$where = array('sid'=>$sid,'uid'=>$uid);
		if(M('answer')->where($where)->delete()){
			M('user')->where(array('uid'=>$uid))->setDec('point',C('DEL_ANSWER'));
			$this->success("删除成功",U('index'));
		}else{
			$this->error("删除失败");
		}
	}
}