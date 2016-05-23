<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link rel="stylesheet" href="/Wenda/Public/Admin/Css/public.css" />
</head>
<body>
<form action="<?php echo U('edit');?>" method="post">
	<table class="table">
		<tr>
			<td colspan='2' class="th">金币奖励规则设置</td>
		</tr>
			<tr>
				<td align='right' width='45%'>回答：</td>
				<td>
					+ <input type="text" name='answer' value='<?php echo (C("answer")); ?>'/>
				</td>
			</tr>
			<tr>
				<td align='right'>回答被采纳：</td>
				<td>
					+ <input type="text" name='accept' value='<?php echo (C("accept")); ?>'/>
				</td>
			</tr>
			<tr>
				<td align='right'>回答被删除：</td>
				<td>
					- <input type="text" name='del_answer' value='<?php echo (C("del_answer")); ?>'/>
				</td>
			</tr>
			<tr>
				<td align='right'>提问被删除：</td>
				<td>
					- <input type="text" name='del_ask' value='<?php echo (C("del_ask")); ?>'/>
				</td>
			</tr>
			<tr>
				<td align='right'>采纳回答被删除：</td>
				<td>
					提问者：&nbsp;- <input type="text" name='del_accept_ask' value='<?php echo (C("del_accept_ask")); ?>'/>&nbsp;&nbsp;
					回答者：&nbsp;- <input type="text" name='del_accept_answer' value='<?php echo (C("del_accept_answer")); ?>'/>
				</td>
			</tr>
			<tr>
				<td colspan='2' height='60' align='center'>
					<input type="submit" value='保存修改' class='input_button'/>
				</td>
			</tr>

</table>
</form>
</body>
</html>