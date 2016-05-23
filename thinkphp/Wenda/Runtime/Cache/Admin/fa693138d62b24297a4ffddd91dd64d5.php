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
			<td class="th" colspan="20">用户列表</td>
		</tr>
		<tr class="tableTop">
			<td class="tdLittle1">ID</td>
			<td>用户名</td>
			<td>回答数</td>
			<td>被采纳数</td>
			<td>提问数</td>
			<td>金币</td>
			<td>经验</td>
			<td>最后登录时间</td>
			<td>最后登录IP</td>
			<td>注册时间</td>
			<td>帐号状态</td>
			<td>操作</td>
		</tr>
		<?php if(is_array($result)): foreach($result as $key=>$v): ?><tr>
			<td><?php echo ($v["uid"]); ?></td>
			<td><?php echo ($v["nickname"]); ?></td>
			<td><?php echo ($v["answer"]); ?></td>
			<td><?php echo ($v["adopt"]); ?></td>
			<td><?php echo ($v["ask"]); ?></td>
			<td><?php echo ($v["point"]); ?></td>
			<td><?php echo ($v["exp"]); ?></td>
			<td><?php echo (time_format($v["logintime"])); ?></td>
			<td><?php echo ($v["loginip"]); ?></td>
			<td><?php echo (time_format($v["restime"])); ?></td>
			<?php if($v['lock']): ?><td>锁定</td>
			<?php else: ?>
			<td>未锁定</td><?php endif; ?>
			<td>
				<?php if(!$v['lock']): ?><a href="">锁定</a>
				<?php else: ?>
				<a href="">解锁</a><?php endif; ?>
			</td>
		</tr><?php endforeach; endif; ?>
	</table>
	<div class="page">
		<?php echo ($page); ?>
	</div>
</body>
</html>