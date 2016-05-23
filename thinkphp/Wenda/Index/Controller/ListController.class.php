<?php
namespace Index\Controller;
use Think\Controller;

class ListController extends CommonController {

	public function index(){
		$cid = I('get.id',0,'intval');

		//分类列表
		$db = M('category');
		$res = $db->where(array('pid'=>$cid))->order('cid asc')->select();
		$cd = only_array($res,'cid');
		$cd[] = $cid;
		
		if(!$res){
			$pid = $db->where(array('cid'=>$cid))->getField('pid');
			$res = $db->where(array('pid'=>$pid))->order('cid asc')->select();

			if(!$res){
				$res = $db->where(array('pid'=>0))->order('cid asc')->select();
				$cd = only_array($res,'cid');
			}
		}	

		$this->cate = $res;

		
		
		//所有问题列表
		$where = array('cid'=>array('IN',$cd));
		//已解决问题未解决问题
		$filter = isset($_GET['filter'])?$_GET['filter']:0;
		switch($filter){
			case 1:
				$where['slove'] = 1;
				break;
			case 2:
				$where['reward'] = array('gt',0);
				break;
			case 3:
				$where['answer'] = 0;
				break;
			default :
				$where['slove'] =  0;
		}
		//分页
		$count = M('ask')->where($where)->count('aid');
		$Page = new \Think\Page($count,1);
		$limit = $Page->firstRow.','.$Page->listRows;
		$myask = D('askview')->where($where)->order('atime desc')->limit($limit)->select();
		$this->page = $Page->show();
		$this->myask = $myask;
		$this->filter = $filter;
		$this->myid = $cid;
		$this->display();	
	}
}