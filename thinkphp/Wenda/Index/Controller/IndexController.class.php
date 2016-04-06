<?php
namespace Index\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){

    	if (S('cate')) {
			$cate = S('cate');
		} else {
			$db = M('category');
			$cate = $db->where(array('pid' => 0))->order(array('cid'=>'asc'))->select();
			foreach ($cate as $k => $v) {
				$cate[$k]['child'] = $db->where(array('pid' => $v['cid']))->order(array('cid'=>'asc'))->select();
			}
			
			S('cate', $cate, 1);
		}
    	
    	//待解决问题
    	$db = M('ask');
    	$this->wait = $db->where(array('slove'=>0,'reward'=>0))->limit(5)->order('atime desc')->select();
    	// p($this->wait);die;
    	// 高悬赏金币
    	$this->rewards = $db->where(array('slove'=>0,'reward'=>array('gt',0)))->limit(5)->order('atime desc')->select();
    	$this->cate = $cate;
        $this->display();
    }
}