<?php
namespace Admin\Model;
use Think\Model\RelationModel;

class AskRelationModel extends RelationModel{

	Protected $tableName = 'ask';

	Protected $_link = array(
		'answer' => array(
			'mapping_type' => HAS_MANY,
			'foreign_key' =>'aid',
			),
		);
}