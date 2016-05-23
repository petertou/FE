<?php
namespace Index\Model;
use Think\Model\ViewModel;

class AskAnswerViewModel extends ViewModel{

	Protected $viewFields = array(
		'Ask'=>array(
			'aid','content','answer',
			'_type'=>'LEFT',
			),
		'Answer' => array(
			'stime','_on'=>'Ask.aid=Answer.aid',
			'_type'=>'LEFT',
			),
		'Category'=>array(
			'name','_on'=>'Ask.cid=Category.cid',
			)
		);
}