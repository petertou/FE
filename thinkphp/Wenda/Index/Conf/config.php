<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING'=>array(
		'__CSS__'=>__ROOT__ . '/Wenda/Public/'.MODULE_NAME.'/Css',
		'__JS__'=>__ROOT__ . '/Wenda/Public/'.MODULE_NAME.'/Js',
		'__IMAGE__'=>__ROOT__ . '/Wenda/Public/'.MODULE_NAME.'/Images',
		),
	// 加载自定义标签库
	// 'TAGLIB_PRE_LOAD'=>"Index\\TagLib\\TagLibMy",
	'TAGLIB_BUILD_IN'	=>	'Cx,Index\TagLib\My',
    'TAGLIB_PRE_LOAD'	=>	'Index\TagLib\My',

);