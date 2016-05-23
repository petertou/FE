<?php
namespace Index\Controller;
use Think\Controller;

class ShowController extends CommonController {

	public function index(){
		$aid = I('get.aid',0,'intval');

		$db = D('AskInfoView');
		$res = D('AskInfoView')->where(array('aid'=>$aid))->find();

		// p($res);die;
		if(!$res){
			redirect(U('List/index'));
		}
		$res['level'] = exp_to_level($res['exp']);
		$sdb = D('AnswerInfoView');
		// 待解决问题
		$where = array('cid'=>$res['cid'],'slove'=>0,'aid'=>array('NEQ',$aid));
		$this->wait = M('ask')->where($where)->select();
		//满意回答
		$agree = $sdb->where(array('answer.aid'=>$aid,'answer.adopt'=>1))->find();
		$this->agree = $agree;
		//所有回答
		$count = D('AnswerInfoView')->where(array('aid'=>$aid,'answer.adopt'=>0))->count();
		$page = new \Think\Page($count,1);
		$limit = $page->firstRow.','.$page->listRows;
		$ress = $sdb->where(array('aid'=>$aid,'answer.adopt'=>0))->limit($limit)->select();

		$this->res = $ress;
		$this->pages=$page->show();
		$this->count=$count;
		$this->info = $res;
		$this->display();
	}

	public function answer(){
		if(!IS_POST) $this->error("您访问的页面不存在");
		$data = array(
			'content'=>I('post.content'),
			'aid' => I('post.aid',0,''),
			'stime' => time(),
			'uid' => session('uid'),
			);
		$res = M('answer')->add($data);
		if($res){
			M('ask')->where(array('aid'=>$data['aid']))->setInc('answer');
			$db = M('user');
			$where = array('uid'=>$data['uid']);
			$db->where($where)->setInc('answer');
			$db->where($where)->setInc('exp',C('LV_ANSWER'));
			$db->where($where)->setInc('point',C('ANSWER'));
			$this->success('回答成功',$_SERVER['HTTP_REFFER']);
		}else{
			$this->success('回答失败');
		}
	}


	public function adopt(){
		//回答ID
		$sid = I('get.sid',0,'intval');
		// 提问ID 
		$aid = I('get.aid',0,'intval');
		// 用户ID
		$uid = I('get.uid',0,'intval');

		$data = array(
				'sid'=>$sid,
				'adopt'=>1,
			);
		// p($data);die;
		$res = M('answer')->save($data);
		if($res){
			$db = M('user');
			$rewards= M('ask')->where(array('aid'=>$aid))->field('uid,reward');
			$resu = M('ask')->where(array('aid'=>$aid))->save(array('slove'=>1));
			$db->where(array('uid'=>$uid))->setInc('adopt');
			$db->where(array('uid'=>$rewards['uid']))->setDec('reward',$rewards['reward']);
			$db->where(array('uid'=>$uid))->setInc('reward',$rewards['reward']);
			$db->where(array('uid'=>$uid))->setInc('exp',C('LV_ADOPT'));
			if($resu){
				$this->success('答案已采纳，.....',$_SERVER['HTTP_REFFER']);
			}else{
				$this->error('采纳失败,请重试...');
			}
		}
	}
}