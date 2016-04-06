<?php
namespace Index\Controller;
use Think\Controller;

class MemberController extends CommonController {

	public function _initialize(){
		$this->role = isset($_SESSION['uid']) && $_GET['id'] == session('uid')?"我":"他";
	}



	public function index(){
		$uid = I('get.id',0,'intval');
		$userinfo = M('user')->where(array('uid'=>$uid))->find();

		if(!$userinfo){
			redirect(__APP__);
			die();
		}
		$this->user = $userinfo;



		//我的提问
		$where = array('uid'=>$uid);
		$db = D('askview');
		$res = $db->where($where)->order(array('atime'=>'desc'))->limit(10)->select();
		$this->res = $res;
		

		//我的回答
		$dbs = D('AskAnswerView');
		$ret = $dbs->where(array('answer.uid'=>$uid))->order(array('stime'=>'desc'))->limit(10)->select();

		$this->ant = $ret;
		



		// $this->role = isset($_SESSION['uid']) && $uid == session('uid')?"我":"他";
		$this->display();
	}

	public function myask(){
		$uid = I('get.id',0,'intval');
		//未解决问题
		$where = array('uid'=>$uid,'slove'=>0);
		$db = D('askview');
		$res = $db->where($where)->order(array('atime'=>'desc'))->limit(10)->select();
		$this->res = $res;
		//已解决问题
		$where['slove'] = 1;
		$ret = $db->where($where)->order(array('atime'=>'desc'))->limit(10)->select();
		$this->ret = $ret;
		$this->display();
	}


	public function myanswer(){
		$uid = I('get.id',0,'intval');
		$dbs = D('AskAnswerView');
		$ret = $dbs->where(array('answer.uid'=>$uid))->order(array('stime'=>'desc'))->limit(10)->select();
		$where['adopt']=1;
		$where['answer.uid']=$uid;
		$res = $dbs->where($where)->order(array('stime'=>'desc'))->limit(10)->select();
		$this->ans = $res;
		$this->ant = $ret;
		$this->display();
	}


	public function mylevel(){
		$uid = I('get.id',0,'intval');
		$where = array('uid'=>$uid);
		$exp = M('user')->where($where)->getField('exp');
		$level = exp_to_level($exp);
		$this->level = $level;
		$this->exp = $exp;
		$this->display();
	}



	public function mygold(){
		$uid = I('get.id',0,'intval');
		$where = array('uid'=>$uid);
		$gold = M('user')->where($where)->getField('point');
		$this->reward = $gold;
		$this->display();
	}

	public function myface(){
		$uid = I('get.id',0,'intval');
		$this->faces = M('user')->where(array('uid'=>$uid))->getField('face');
		$this->display();
	}

	public function faces(){
		$id = I('get.id',0,'intval');
		$upload = new \Think\Upload();// 实例化上传类
	    $upload->maxSize   =     3145728 ;// 设置附件上传大小
	    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
	    $upload->rootPath  =     './Upload/Face/'; // 设置附件上传根目录
	    $upload->savePath  =     ''; // 设置附件上传（子）目录


		$info = $upload->upload();
	    if(!$info) {// 上传错误提示错误信息
	        $this->error($upload->getError());
	    }else{// 上传成功
	    	$oface = M('user')->where(array('uid'=>$id))->getField('face');
	    	$oPic = './Upload/Face/'.$oface;
	    	if($oface != ''){
	    		if(unlink($oPic)){
	    		$face = $info['face']['savepath'].$info['face']['savename'];
		    	$data = array(
		    		'face' => $face,
		    		'uid'=>$id
		    		);
		    		$rs = M('user')->save($data);
			    	if($rs){
			    		$this->success('上传成功！');
			    	}else{
			    		$this->error('数据库写入失败');
				    }
		    	}else{
		    		$this->error('删除文件失败');
		    	}
	    	}else{
	    		$face = $info['face']['savepath'].$info['face']['savename'];
		    	$data = array(
		    		'face' => $face,
		    		'uid'=>$id
		    		);
		    	$rs = M('user')->save($data);
		    	$this->success('上传成功！');
	    	} 
	    }
	}

}