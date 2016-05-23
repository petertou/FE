<?php
namespace Index\Model;
use Think\Model\ViewModel;

class AskInfoViewModel extends ViewModel {
	Protected $viewFields = array(
		'ask'=>array(
			'aid','content','reward','slove','atime','cid','uid','answer',
			'_type'=>'LEFT'
			),
		'user'=>array(
			'uid','exp','nickname',
			'_on'=>'user.uid=ask.uid',
			),
	);

}