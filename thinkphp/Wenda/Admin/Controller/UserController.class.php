<?php
namespace Admin\Controller;
use Think\Controller;

class UserController extends CommonController{


	public function index(){
		$db = M('user');
		$count = $db->count();
		$pages = new \Think\Page($count,1);
		$limit = $pages->firstRow.','.$pages->listRows;
		$result = $db->limit($limit)->select();
		
		$this->result = $result;
		$this->page = $pages->show();
		$this->display();
	}
}