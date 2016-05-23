<?php
namespace Index\Model;
use Think\Model;

class UserModel extends Model{

	protected $_map = array(
			'username'=>'user',
			'pwd' =>'passwd',
		);
	protected $_validate = array(
			
		array('user', 'require', '帐号不能为空'),
		array('user', '/^[a-zA-Z]\w{6,19}$/s', '帐号格式不正确', 0, 'regex',3),
		array('user', '', '帐号已存在', 1, 'unique'),
		array('nickname', 'require', '用户名不能为空'),
		array('nickname', '/^[\x80-\xff\w]{2,14}$/s', '用户名格式不正确', 0, 'regex',3),
		array('nickname', '', '用户名已存在', 1, 'unique'),
		array('passwd', 'require', '密码不能空'),
		array('passwd', '/^[a-zA-Z]\w{6,19}$/s', '密码格式不正确',0,'regex',3),
		array('pwded', 'passwd', '两次密码不一致', 0, 'confirm')
		);

	protected $_auto = array(
			array('passwd','md5',1,'function'),
			array('logintime','time',1,'function'),
			array('loginip','get_client_ip',1,'function'),
			array('restime','time',1,'function'),
		);

}