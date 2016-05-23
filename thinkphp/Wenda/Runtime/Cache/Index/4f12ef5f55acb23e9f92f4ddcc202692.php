<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>后盾问答</title>
	<meta name="keywords" content="后盾问答"/>
	<meta name="description" content="后盾问答"/>
	<link rel="stylesheet" href="/Wenda/Public/Index/Css/common.css" />
	<script type="text/javascript" src='/Wenda/Public/Index/Js/jquery-1.7.2.min.js'></script>
	<script type="text/javascript" src='/Wenda/Public/Index/Js/top-bar.js'></script>
	<link rel="stylesheet" href="/Wenda/Public/Index/Css/member.css" />
	<script type="text/javascript" src='/Wenda/Public/Index/Js/member.js'></script>
</head>
<body>
	<!-- top -->
<!-- top -->
	<div id='top-fixed'>
	<div id='top-bar'>
		<ul class="top-bar-left fl">
			<li><a href="http://www.houdunwang.com" target='_blank'>后盾顶尖后盾PHP培训</a></li>
			<li><a href="http://www.houdunwang.com" target='_blank'>后盾论坛</a></li>
		</ul>
		<ul class='top-bar-right fr'>
			<?php if(isset($_SESSION[uid]) || isset($_SESSION[user])): ?><li class='userinfo'>
				<a href="<?php echo U('Member/index');?>" class='uname'><?php echo (session('user')); ?></a>
			</li>
			<li style='color:#eaeaf1'>|</li>
			<li><a href="<?php echo U('Common/logout');?>">退出</a></li>
			<?php else: ?>
			<li><a href="" class='login'>登录</a></li>
			<li style='color:#eaeaf1'>|</li>
			<li><a href="" class='register'>注册</a></li><?php endif; ?>
		</ul>
	</div>
<!-- 提问搜索框 -->
	<div id='search'>
		<div class='logo'><a href="" class='logo'></a></div>
		<form action="" method=''>
			<input type="text" name='' class='sech-cons'/>
			<input type="submit" class='sech-btn'/>
		</form>
		<a href="<?php echo U('Ask/index');?>" class='ask-btn'></a>
	</div>
<!-- 提问搜索框结束 -->
</div>
<div style='height:110px'></div>
<!----------导航条---------->
<div id='nav'>
	<ul class='list'>
		<li class='nav-sel'><a href="/Index/index/index" class='home'>问答首页</a></li>
		<li class='nav-sel ask-cate'>
			<a href="" class='ask-list'><span>问题库</span><i></i></a>
			<ul class='hidden'>
			<?php $where = array("pid" => 0);$_topcatesResult = M("category")->where($where)->limit(10)->order("cid asc")->select();foreach ($_topcatesResult as $v) : extract($v);?><li>
					<a href="<?php echo U('List/index',array('id'=>$cid));?>"><?php echo ($name); ?></a>
				</li><?php endforeach ?>
			</ul>
		</li>
	</ul>
	<p class='total'>累计提问：1123211</p>
</div>
<?php if(!isset($_SESSION['uid']) || !isset($_SESSION['user'])): ?><script type="text/javascript" src="/Wenda/Public/Index/Js/validate.js"></script>
<script type="text/javascript">
	var APP = "/Index/Common";
</script>
	<!----------注册框---------->
	<div id='register' class='hidden'>
		<div class='reg-title'>
			<p>欢迎注册后盾问答</p>
			<a href="" title='关闭' class='close-window'></a>
		</div>
		<div id='reg-wrap'>
			<div class='reg-left'>
				<ul>
					<li><span>账号注册</span></li>
				</ul>
				<div class='reg-l-bottom'>
					已有账号，<a href="" id='login-now'>马上登录</a>
				</div>
			</div>
			<div class='reg-right'>
				<form action="<?php echo U('Common/Register');?>" method='post' name='register'>
					<ul>
						<li>
							<label for="reg-uname">用户名</label>
							<input type="text" name='username' id='reg-uname'/>
							<span>2-14个字符：字母、数字或中文</span>
						</li>
						<li>
							<label for="reg-uname">昵称</label>
							<input type="text" name='nickname' id='reg-uname'/>
							<span>2-14个字符：字母、数字或中文</span>
						</li>
						<li>
							<label for="reg-pwd">密码</label>
							<input type="password" name='pwd' id='reg-pwd'/>
							<span>6-20个字符:字母、数字或下划线 _</span>
						</li>
						<li>
							<label for="reg-pwded">确认密码</label>
							<input type="password" name='pwded' id='reg-pwded'/>
							<span>请再次输入密码</span>
						</li>
						<li>
							<label for="reg-verify">验证码</label>
							<input type="text" name='verify' id='reg-verify'/>
							<img src="<?php echo U('Common/Verify');?>" width='99' height='35' alt="验证码" id='verify-img'/>
							<span>请输入图中的字母或数字，不区分大小写</span>
						</li>
						<li class='submit'>
							<input type="submit" value='立即注册'/>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>

	<!----------登录框---------->	
	<div id='login' class='hidden'>
		<div class='login-title'>
			<p>欢迎您登录后盾问答</p>
			<a href="" title='关闭' class='close-window'></a>
		</div>
		<div class='login-form'>
			<span id='login-msg'></span>
			<!-- 登录FORM -->
			<form action="<?php echo U('Common/Login');?>" method='post' name='login'>
				<ul>
					<li>
						<label for="login-acc">账号</label>
						<input type="text" name='account' class='input' id='login-acc'/>
					</li>
					<li>
						<label for="login-pwd">密码</label>
						<input type="password" name='pwd' class='input' id='login-pwd'/>
					</li>
					<li class='login-auto'>
						<label for="auto-login">
							<input type="checkbox" checked='checked' name='auto'  id='auto-login'/>&nbsp;下一次自动登录
						</label>
						<a href="" id='regis-now'>注册新账号</a>
					</li>
					<li>
						<input type="submit" value='' id='login-btn'/>
					</li>
				</ul>
			</form>
		</div>
	</div><?php endif; ?>
<!--背景遮罩--><div id='background' class='hidden'></div>
<!-- top -->	
<!-- top结束 -->
<!--------------------中部-------------------->
	<div id='center'>
<!-- 左侧 -->
<div id='left'>
<?php $uid=$_GET['id'] ?>
<?php  $field = array('uid','nickname','face','answer','adopt','ask','point','exp'); $where = array('uid'=>$uid); $_userInfoResult = M('user')->field($field)->where($where)->find(); extract($_userInfoResult); $face = empty($face)? '/Wenda/Public/Index/Images/noface.gif':'/Upload/Face/'.$face; if($answer != 0){ $adopt = round($adopt / $answer *100,1). '%'; }else{ $adopt = '0%'; } $level = exp_to_level(); ?>	<div class='userinfo'>
			<dl>
				<dt>
					<a href="<?php echo U('Member/index',array('id'=>$_GET['id']));?>"><img src="<?php echo ($face); ?>" width='48' height='48' alt="占位符"/></a>
				</dt>
				<dd class='username'>
					<a href="<?php echo U('Member/index',array('id'=>$_GET['id']));?>"><b><?php echo ($nickname); ?></b>
					</a>
					<a href="<?php echo U('Member/index',array('id'=>$_GET['id']));?>">
						<i class='level lv<?php echo ($level); ?>' title='Level<?php echo ($level); ?>'></i>
					</a>
				</dd>
				<dd>金币：<a href="<?php echo U('Member/mygold',array('id'=>$_GET['id']));?>" style="color: #888888;"><b class='point'><?php echo ($point); ?></b></a></dd>
				<dd>经验值：<?php echo ($exp); ?></dd>
			</dl>
			<table>
				<tr>
					<td>回答数</td>
					<td>采纳率</td>
					<td class='last'>提问数</td>
				</tr>
				<tr>
					<td><a href="<?php echo U('Member/myanswer',array('id'=>$_GET['id']));?>"><?php echo ($answer); ?></a></td>
					<td><a href=""><?php echo ($adopt); ?></a></td>
					<td class='last'><a href="<?php echo U('Member/myask',array('id'=>$_GET['id']));?>"><?php echo ($ask); ?></a></td>
				</tr>
			</table>
		</div>
	<ul>
		<li class='myhome <?php if(ACTION_NAME == 'index'): ?>cur<?php endif; ?>'>
			<a href="<?php echo U('Member/index',array('id'=>$_GET['id']));?>"><?php echo ($role); ?>的首页</a>
		</li>
		<li class='myask <?php if(ACTION_NAME == 'myask'): ?>cur<?php endif; ?>'>
			<a href="<?php echo U('Member/myask',array('id'=>$_GET['id']));?>"><?php echo ($role); ?>的提问</a>
		</li>
		<li class='myanswer <?php if(ACTION_NAME == 'myanswer'): ?>cur<?php endif; ?>'>
			<a href="<?php echo U('Member/myanswer',array('id'=>$_GET['id']));?>"><?php echo ($role); ?>的回答</a>
		</li>
		<li class='mylevel <?php if(ACTION_NAME == 'mylevel'): ?>cur<?php endif; ?>'>
			<a href="<?php echo U('Member/mylevel',array('id'=>$_GET['id']));?>"><?php echo ($role); ?>的等级</a>
		</li>
		<li class='mygold <?php if(ACTION_NAME == 'mygold'): ?>cur<?php endif; ?>'>
			<a href="<?php echo U('Member/mygold',array('id'=>$_GET['id']));?>"><?php echo ($role); ?>的金币</a>
		</li>
		<?php if($_GET['id'] == session('uid')): ?><li class='myface <?php if(ACTION_NAME == 'myface'): ?>cur<?php endif; ?>'>
				<a href="<?php echo U('Member/myface',array('id'=>$_GET['id']));?>">上传头像</a>
			</li><?php endif; ?>
		<li style="background:none"></li>
	</ul>
</div>
<!-- 左侧结束 -->

		<div id='right'>
			<p class='title'><?php echo ($role); ?>的等级</p>
			<p class='lv-info'>恭喜您，已经升到 <span>Lv<?php echo ($level); ?></span> 级啦，距下一级还需 <span></span> <?php echo C('LV'.($level+1))-$exp; ?>经验值!</p>
			<div class='lv-rule'>
				<p><span>等级规则</span></p>
				<table class='lv-exp'>
					<tr>
						<th>等级</th>
						<th>经验值</th>
					</tr>
					<?php $__FOR_START_1828238555__=1;$__FOR_END_1828238555__=21;for($i=$__FOR_START_1828238555__;$i < $__FOR_END_1828238555__;$i+=1){ if($level != $i): ?><tr>
							<td><?php echo ($i); ?></td>
							<td>
								<?php echo C('LV'.$i);?>
							</td>
						</tr>
						<?php else: ?>
							<tr class="cur">
								<td >我的现在<span><?php echo ($level); ?></span>级</td>
								<td><span><?php echo ($exp); ?></span></td>
							</tr><?php endif; } ?>
				</table>
			</div>
			<div class='lv-rule'>
				<p><span>经验获取规则</span></p>
				<table class='lv-exp'>
					<tr>
						<th>操作</th>
						<th>获得经验值</th>
					</tr>
					<tr>
						<td>每天登录</td>
						<td><?php echo (C("lv_login")); ?></td>
					</tr>
					<tr>
						<td>提问</td>
						<td><?php echo (C("lv_ask")); ?></td>
					</tr>
					<tr>
						<td>回答</td>
						<td><?php echo (C("lv_answer")); ?></td>
					</tr>
					<tr>
						<td>采纳与被采纳</td>
						<td><?php echo (C("lv_adopt")); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<!--------------------中部结束-------------------->
<!-- 底部 -->
<!-- 底部 -->
	<div id='bottom'>
		<p><?php echo (C("COPY")); ?></p>
		<p><?php echo (C("RECORD")); ?></p>
	</div>
<!--[if IE 6]>
    <script type="text/javascript" src="/Wenda/Public/Index/Js/iepng.js"></script>
    <script type="text/javascript">
    	DD_belatedPNG.fix('.logo','background');
        DD_belatedPNG.fix('.nav-sel a','background');
        DD_belatedPNG.fix('.ask-cate i','background');
    </script>
<![endif]-->
</body>
</html>
<!-- 底部结束 -->	
<!-- 底部结束 -->