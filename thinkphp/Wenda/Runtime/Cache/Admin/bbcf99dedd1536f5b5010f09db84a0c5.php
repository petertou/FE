<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link rel="stylesheet" href="/Wenda/Public/Admin/Css/public.css" />
	<script type="text/javascript" src="/Wenda/Public/Admin/Js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/Wenda/Public/Admin/Js/public.js"></script>	
</head>

<body>
	<table class="table">
		<tr>
			<td class="th" colspan="20">问题列表</td>
		</tr>
		<tr class="tableTop">
			<td class="tdLittle1">ID</td>
			<td>问题内容</td>
			<td>提问时间</td>
			<td>回答人数</td>
			<td>悬赏金币</td>
			<td>操作</td>
		</tr>
		<?php if(is_array($result)): foreach($result as $key=>$v): ?><tr>
			<td><?php echo ($v["aid"]); ?></td>
			<td><?php echo ($v["content"]); ?></td>
			<td><?php echo (time_format($v["atime"])); ?></td>
			<td><?php echo ($v["answer"]); ?></td>
			<td><?php echo ($v["reward"]); ?></td>
			<td>
				<a href="<?php echo U('Ask/del',array('aid'=>$v['aid']));?>" class="del">删除</a>
			</td>
		</tr><?php endforeach; endif; ?>
	</table>
	<div class="page">
		<?php echo ($page); ?>
	</div>

</body>
</html>