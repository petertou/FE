<?php

// 打印函数
function p($arr){
	echo "<pre>";
	print_r($arr);
	echo "<pre/>";
}


// 打印常量
function print_const(){
	$const = get_defined_constants(true);
	p($const['user']);
}

//验证码检测

function check_verify($code, $id = ''){
	$verify = new \Think\Verify();
	return $verify->check($code, $id); 
}

//无限极分类
function recurse($arr,$pid = 0,$level=0){
	$array = array();
	foreach ($arr as $v) {
		if($v['pid']== $pid){
			$v['level'] = $level;
			$v['html'] = str_repeat('--', $level);
			$array[]= $v;
			$array = array_merge($array,recurse($arr,$v['cid'],$level+1));
		}
	}

	return $array;
}

// 获取父类的子元素
function get_child($array,$id){
	$arr = array();

	foreach ($array as $v) {
		if($v['pid']== $id){
			$arr[] = $v['cid'];
			$arr = array_merge($arr,get_child($array,$v['cid']));
		}
	}

	return $arr;
}

//异位或加密
function encrytion($value,$type=0){
	$key = md5(C('login_key'));
	if($type){
		return str_replace('=','',base64_encode($value ^ $key));
	}

	if(!$type){
		$value = base64_decode($value);
		return $value ^ $key;
	}
}

/**
 * 经验值转换为等级
 * @param  [type] $exp [description]
 * @return [type]      [description]
 */
function exp_to_level ($exp) {
	switch (true) {
		case $exp >= C('LV20') :
			return 20;
		case $exp >= C('LV19') :
			return 19;
		case $exp >= C('LV18') :
			return 18;
		case $exp >= C('LV17') :
			return 17;
		case $exp >= C('LV16') :
			return 16;
		case $exp >= C('LV15') :
			return 15;
		case $exp >= C('LV14') :
			return 14;
		case $exp >= C('LV13') :
			return 13;
		case $exp >= C('LV12') :
			return 12;
		case $exp >= C('LV11') :
			return 11;
		case $exp >= C('LV10') :
			return 10;
		case $exp >= C('LV9') :
			return 9;
		case $exp >= C('LV8') :
			return 8;
		case $exp >= C('LV7') :
			return 7;
		case $exp >= C('LV6') :
			return 6;
		case $exp >= C('LV5') :
			return 5;
		case $exp >= C('LV4') :
			return 4;
		case $exp >= C('LV3') :
			return 3;
		case $exp >= C('LV2') :
			return 2;
		default : 
			return 1;
	}
}
//格式化时间函数
function time_format($time){
	$now = time();
	$today = strtotime(date('y-m-d'));
	$yestoday = strtotime('-1 day',$today);

	$diff = $now - $time;
	$str = '';
	switch(true){
		case $diff < 60:
			$str = '刚刚';
			break;
		case $diff < 3600:
			$str = floor($diff/60).'分钟前';
			break;
		case $diff < 3600*8:
			$str = floor($diff/3600).'小时前';
			break;
		case $time > $today:
			$str = '今天'.date('H:i',$time);
			break;
		case $time > $yestoday:
			$str = '昨天'.date('H:i',$time);
			break;
		default:
			$str = date('y-m-d H:i',$time);
			break;
	}

	return $str;
}
//生成合适条件一维数组
function only_array($array,$field){
	$arr = array();
	foreach ($array as $v) {
		$arr[]=$v[$field];
	}

	return $arr;
}

// 寻找父类
function get_parent($array,$id){
	$arr = array();
	foreach ($array as  $v) {
		if($v['cid'] == $id){
			$arr[] = $v;
			$arr = array_merge($arr,get_parent($array,$v['pid']));
		}
	}
	return $arr;
}	


?>
