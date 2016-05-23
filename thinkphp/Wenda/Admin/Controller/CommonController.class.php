<?php  
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller {

	public function _initialize(){
		if(!isset($_SESSION['uid'])|| !isset($_SESSION['user'])){
			$this->redirect('admin/login/index');
		}
	}
}