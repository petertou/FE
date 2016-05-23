<?php 
namespace Index\Model;
use Think\Model\ViewModel;

class AnswerInfoViewModel extends ViewModel{

	public $viewFields = array(
		'answer'=>array('sid','content','stime','aid','adopt'=>'ad',
			'_type'=>'LEFT'),
		'user'=>array('uid','nickname','face','exp','adopt','answer',
			'_on'=>'answer.uid=user.uid',
			),

		);
}