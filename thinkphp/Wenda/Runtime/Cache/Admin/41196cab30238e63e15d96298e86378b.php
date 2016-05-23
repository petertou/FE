<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link rel="stylesheet" href="/Wenda/Public/Admin/Css/public.css" />
	<script type="text/javascript" src="/Wenda/Public/Admin/Js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/Wenda/Public/Admin/Js/public.js"></script>
	<script type="text/javascript">
		$(function(){
			$('tr[pid != 0]').hide();
			$('.showPlus').toggle(function() {
				var index = $(this).parents('tr').attr('id');
				$('tr[pid='+index+']').show();
				$(this).removeClass('showPlus').addClass('showMinus');
			}, function() {
				var index = $(this).parents('tr').attr('id');
				$('tr[pid='+index+']').hide();
				$(this).removeClass('showMinus').addClass('showPlus');
			});
			
		})
	</script>
</head>

<body>
	<table class="table">
		<tr pid='0'>
			<td class="th" colspan="20">分类列表</td>
		</tr>
		<tr pid='0' class="tableTop">
			<td class="tdLittle0 center">展开</td>
			<td class="tdLittle1">ID</td>
			<td>分类名称</td>
			<td class="tdLtitle7">操作</td>
		</tr>
		<?php foreach($cate as $v): ?>
		<tr id='<?php echo ($v["cid"]); ?>' pid='<?php echo ($v["pid"]); ?>'>
			<td><a href="javascript:void(0)" class="showPlus"></a></td>
			<td><?php echo ($v["cid"]); ?></td>
			<td><?php echo str_repeat("&nbsp;&nbsp;",$v['level']); if($v['level'] > 0): ?>|<?php endif; echo ($v["html"]); echo ($v["name"]); ?></td>
			
			<td>
				[<a href="<?php echo U('admin/category/add_cate',array('cid'=>$v['cid']));?>">添加子分类</a>][
				<a href="<?php echo U('admin/category/edit_cate',array('cid'=>$v['cid']));?>">修改</a>][
				<a href="<?php echo U('admin/category/del',array('cid'=>$v['cid']));?>" class="del dell">删除</a>]
			</td>
		</tr>
		<?php endforeach; ?>
	</table>

</body>
</html>