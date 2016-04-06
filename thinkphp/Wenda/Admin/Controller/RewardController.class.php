<?php
namespace Admin\Controller;
use Think\Controller;

class RewardController extends CommonController{

	public function index(){
		$this->display();
	}

	public function edit(){
		// p($_POST);
		$file = './Wenda/Common/Conf/config.php';
		$config = include $file;
		$config = array_merge($config,array_change_key_case($_POST,CASE_UPPER));
		$str = "<?php\r\nreturn ".var_export($config,true).";\r\n?>";
		if(file_put_contents($file, $str)){
			$this->success('修改成功',$_SERVER['HTTP_REFERER']);
		}else{
			$this->error('修改失败');
		}
	}


	public function level(){
		$this->display('level');
	}
}