<?php  

namespace Admin\Controller;
use Think\Controller;

class CategoryController extends CommonController {

	public function index(){
		$cate = M('category')->select();
		$this->cate = recurse($cate);
		$this->display('category');
	}

	public function addTop(){
		$this->display('add_top_cate');
	}

	/**
	 * [add 添加分类]
	 */
	public function add(){
		$db = M('category');
		$data =array( 
			'name'=> I('post.title'), 
			'pid'=> I('post.pid',0,'intval'), 
			);
		$result = $db->add($data);
		if($result){
			$this->success('添加成功',U('admin/category/index'));
		}else{
			$this->error('添加失败');
		}
	}

	public function add_cate(){
		$db = M('category');
		$cid = I('get.cid',0,'intval');
		$where = array('cid'=>$cid);
		$res = $db->where($where)->find();
		$this->cate = $res;
		$this->display();
	}

	public function edit_cate(){
		$db = M('category');
		$cid = I('get.cid',0,'intval');
		$res = $db->where(array('cid'=>$cid))->find();
		if($res['pid'] != 0){
			$ress = $db->where(array('cid'=>$res['pid']))->find();
		}else{
			$ress = $res;
		}
		$this->cate = $res;
		$this->cates = $ress;
		$this->display();
	}


	public function edit(){
		$db = M('category');
		$cid = I('post.cid',0,'intval');
		$where = array('cid'=>$cid);
		$data = array(
			'name'=>I('post.title'),
			'cid'=>$cid,
			);
		$result = $db->save($data);
		if($result){
			$this->success('修改成功',U('admin/category/index'));
		}else{
			$this->error('修改失败');
		}
	}


	public function del(){
		$db = M('category');
		$cid = I('get.cid',0,'intval');
		$delid = $db->field('cid,pid')->select();
		$dd = get_child($delid,$cid);
		$dd[] = $cid;
		$where = array('cid' => array('IN', $dd));
		$result = $db->where($where)->delete();
		if(!$result){
			$this->error('删除失败');
		}

		$this->success('删除成功',U('admin/category/index'));
	}
}