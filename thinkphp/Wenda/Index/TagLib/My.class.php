<?php
namespace Index\TagLib;
use Think\Template\TagLib;

class My extends TagLib{
	
	Protected $tags = array(
		'topcate' => array('attr' => 'limit,order','close'=>1),
		'userinfo'=>array('attr'=>'uid','close'=>1),
		'location'=>array('attr'=>'cid','close'=>1),
		);

	//顶级分类对标签
	Public function _topcate ($tag, $content) {
		$attr = $this->parseXmlAttr($attr);
		$limit = $tag['limit'];
		$order = $tag['order'];
		$str = '<?php ';
		$str .= '$where = array("pid" => 0);';
		$str .= '$_topcatesResult = M("category")->where($where)->limit(' . $limit . ')->order("' .$order. '")->select();';
		$str .= 'foreach ($_topcatesResult as $v) : ';
		$str .= 'extract($v);?>';
		$str .= $content;
		$str .= '<?php endforeach ?>';

		return $str;
	}

	//用户信息
	Public function _userinfo($tag,$content){
		$attr = $this->parseXmlAttr($attr);
		$uid = $tag['uid'];
		
		$str = <<<str
<?php 
		\$field = array('uid','nickname','face','answer','adopt','ask','point','exp');
		\$where = array('uid'=>\$uid);
		\$_userInfoResult = M('user')->field(\$field)->where(\$where)->find();
		extract(\$_userInfoResult);
		\$face = empty(\$face)? '__IMAGE__/noface.gif':'/Upload/Face/'.\$face;
		if(\$answer != 0){
			\$adopt = round(\$adopt / \$answer *100,1). '%';
		}else{
			\$adopt = '0%';
		} 
		
		\$level = exp_to_level($exp);

?>	
str;
		$str .= $content;
		return $str;

	}

	public function _location($tag,$content){
		$attr = $this->parseXmlAttr($attr);
		$cid = $tag['cid'];
		$str = <<<str
<?php
		\$cid = {$cid};
		if(S('location_'. \$cid)){
			\$_location_result = S('location_' . \$cid);
		}else{
			\$_location_result = M('category')->select();
			\$_location_result = array_reverse(get_parent(\$_location_result,\$cid));
			S('location_' . \$cid);
		}
		
		
		foreach(\$_location_result as \$v):
			extract(\$v);
		
?>
str;
		$str .= $content;
		$str .= '<?php endforeach ;?>';
		return $str;
	}
}