<?php
namespace Index\Model;
use Think\Model\ViewModel;

class AskViewModel extends ViewModel {
	public $viewFields = array(
		'ask'=>array('aid','content','answer','cid','atime','uid','reward','slove','_type'=>'LEFT'),
		'category'=>array('name','_on'=>'category.cid=ask.cid'),
	);
}