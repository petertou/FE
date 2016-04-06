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
	<link rel="stylesheet" href="/Wenda/Public/Index/Css/question.css" />
	<script type="text/javascript" src="/Wenda/Public/Index/Js/question.js"></script>
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
<!-- top 结束-->
	<div id='location'>
		<a href="">全部分类</a>&nbsp;&gt;&nbsp;
		<?php
 $cid = $info['cid']; if(S('location_'. $cid)){ $_location_result = S('location_' . $cid); }else{ $_location_result = M('category')->select(); $_location_result = array_reverse(get_parent($_location_result,$cid)); S('location_' . $cid); } foreach($_location_result as $v): extract($v); ?><a href="<?php echo U('List/index',array('id'=>$cid));?>"><?php echo ($name); ?></a>
			<?php if($info['cid']!=$cid): ?>&nbsp;&gt;&nbsp;<?php endif; endforeach ;?>	
	</div>

<!--------------------中部-------------------->
	<div id='center-wrap'>
		<div id='center'>
			<div id='left'>
				<div id='answer-info'>
					<!-- 如果没有解决用wait -->
					<div class='ans-state <?php if(!$info['slove']): ?>wait<?php endif; ?>'></div>
					<div class='answer'>
						<p class='ans-title'><?php echo ($info["content"]); ?>
							<b class='point'><?php if($info['reward'] != 0): echo ($info["reward"]); endif; ?></b>
						
						</p>
					</div>
					<ul>
						<li><a href="<?php echo U('Member/index',array('id'=>$info['cid']));?>"><?php echo ($info["nickname"]); ?></a></li>
						<li><i class='level lv<?php echo ($info["level"]); ?>' title='Level 1'></i></li>
						<li><?php echo (time_format($info["atime"])); ?></li>
				
					</ul>
					<?php if(!$info['slove'] AND isset($_SESSION['uid']) AND $_SESSION['uid'] != $info['uid']): ?><div class='ianswer'>
						<form action="<?php echo U('answer');?>" method='POST'>
							<p>我来回答</p>
							<textarea name="content"></textarea>
							<input type="hidden" name='aid' value='<?php echo ($info["aid"]); ?>'>
							<input type="submit" value='提交回答' id='anw-sub'/>
						</form>
					</div><?php endif; ?>
					<!-- 满意回答 -->
					<?php if($agree): ?><div class='ans-right'>
						<p class='title'><i></i>满意回答<span><?php echo (time_format($agree["stime"])); ?></span></p>
						<p class='ans-cons'><?php echo ($agree["content"]); ?></p>
						<dl>
							<dt>
								<a href="<?php echo U('Member/index',array('id'=>$agree['uid']));?>"><img src="<?php if($agree["face"]): ?>/Uploads/Face/$agree['face']<?php else: ?>/Wenda/Public/Index/Images/noface.gif<?php endif; ?>" width='48' height='48'/></a>
							</dt>
							<dd>
								<a href=""><?php echo ($agree["nickname"]); ?></a>
							</dd>
							<dd><i class='level lv<?php echo (exp_to_level($agree["exp"])); ?>'></i></dd>
							<dd><?php echo floor(($agree['adopt']/$agree['answer'])*100);?>%</dd>
						</dl>
					</div><?php endif; ?>
					<!-- 满意回答 -->
				</div>

				<div id='all-answer'>
					<div class='ans-icon'></div>
					<p class='title'>共 <strong><?php echo ($info['answer']); ?></strong> 条回答</p>
					<ul>
					<?php if(is_array($res)): foreach($res as $key=>$v): ?><li>
							<div class='face'>
								<a href="<?php echo U('Member/index',array('id'=>$agree['uid']));?>">
									<img src="<?php if($v["face"]): ?>/Uploads/Face/<?php echo ($v["face"]); else: ?>/Wenda/Public/Index/Images/noface.gif<?php endif; ?>" width='48' height='48'/>
									<?php echo ($v["nickname"]); ?>
								</a>
							</div>
							<div class='cons blue'>
								<p><?php echo ($v["content"]); ?><span style='color:#888;font-size:12px'>&nbsp;&nbsp;(<?php echo (time_format($v["stime"])); ?>)</span></p>
							</div>
							<?php if(!$info['slove'] AND isset($_SESSION['uid']) AND $info['uid'] == $_SESSION['uid']): ?><a href="<?php echo U('adopt',array('sid'=>$v['sid'],'aid'=>$info['aid'],'uid'=>$v['uid']));?>" class='adopt-btn'>采纳</a><?php endif; ?>
						</li><?php endforeach; endif; ?>
					</ul>	
					<div class='page'>
						<?php echo ($pages); ?>
					</div>
				</div>
				<div id='other-ask'>
					<p class='title'>待解决的相关问题</p>
					<table>
						<?php if(is_array($wait)): foreach($wait as $key=>$v): ?><tr>
							<td class='t1'><a href="<?php echo U('Show/index',array('aid'=>$v['aid']));?>"><?php echo ($v["content"]); ?></a></td>
							<td><?php echo ($v["answer"]); ?>&nbsp;回答</td>
							<td><?php echo (time_format($v["atime"])); ?></td>
						</tr><?php endforeach; endif; ?>
					</table>
				</div>
			</div>
		<!-- 右侧 -->
	<div id='right'>
	<?php if(!isset($_SESSION['uid']) && !isset($_SESSION['user'])): ?><div class='r-login'>
		<span class='login'><i></i>&nbsp;登录</span>
		<span class='register'><i></i>&nbsp;注册</span>
	</div>
	<?php else: ?>
	<?php $uid = $_SESSION['uid'] ?>
	<?php  $field = array('uid','nickname','face','answer','adopt','ask','point','exp'); $where = array('uid'=>$uid); $_userInfoResult = M('user')->field($field)->where($where)->find(); extract($_userInfoResult); $face = empty($face)? '/Wenda/Public/Index/Images/noface.gif':'/Uploads/Face/'.$face; if($answer != 0){ $adopt = round($adopt / $answer *100,1). '%'; }else{ $adopt = '0%'; } $level = exp_to_level(); ?>	<div class='userinfo'>
		<dl>
			<dt>
				<a href="<?php echo U('Member/index',array('id' => $uid));?>"><img src="<?php echo ($face); ?>" width='48' height='48' alt="占位符"/></a>
			</dt>
			<dd class='username'>
				<a href="<?php echo U('Member/index',array('id' => $uid));?>">
					<b><?php echo ($nickname); ?></b>
				</a>
				<a href="">
					<i class='level lv<?php echo ($level); ?>' title='Level <?php echo ($level); ?>'></i>
				</a>
			</dd>
			<dd>金币：<a href="" style="color: #888888;"><?php echo ($point); ?><b class='point'></b></a></dd>
			<dd>经验值：<?php echo ($exp); ?></dd>
		</dl>
		<table>
			<tr>
				<td>回答数</td>
				<td>采纳率</td>
				<td class='last'>提问数</td>
			</tr>
			<tr>
				<td><a href=""><?php echo ($answer); ?></a></td>
				<td><a href=""><?php echo ($adopt); ?></a></td>
				<td class='last'><a href=""><?php echo ($ask); ?></a></td>
			</tr>
		</table>
		<ul>
			<li><a href="">我提问的</a></li>
			<li><a href="">我回答的</a></li>
		</ul>
	</div><?php endif; ?>
<div class='clear'></div>
<div class='star'>
	<?php  $times = strtotime(date('Y-m-d')); $sql = "SELECT `uid`, count( * ) AS count  FROM dd_answer `answer` WHERE `answer`.`stime`>$times GROUP BY `uid`  ORDER BY count DESC LIMIT 1 "; if(!$sql){ $result = M()->query($sql); $uid = $result[0]['uid']; $sqls = "SELECT `face`,`nickname`,`exp`,`answer`,`adopt`FROM `dd_user` `user` WHERE `user`.`uid` = $uid"; $result = M()->query($sqls); $result = $result[0]; } ?>
	<?php if(!isset($uid)): ?><p class='title'>后盾问答之星</p>
	<span class='star-name'>本日回答问题最多的人</span>
		<div class='star-info'>
			<div>
				<a href="<?php echo U('Member/index',array('id'=>$uid));?>" class='star-face'>
					<img src="<?php if($result["face"]): ?>/Uploads/Face/<?php echo ($result['face']); else: ?>/Wenda/Public/Index/Images/noface.gif<?php endif; ?>" width='48px' height='48px' alt="头像站位"/>
				</a>
				<ul>
					<li><a href="<?php echo U('Member/index',array('id'=>$uid));?>"><?php echo ($result["nickname"]); ?></a></li>
					<i class='level lv<?php echo (exp_to_level($result["exp"])); ?>' title='Level <?php echo (exp_to_level($result["exp"])); ?>'></i>
				</ul>
			</div>
			<ul class='star-count'>
				<li>回答数：<span><?php echo ($result["answer"]); ?></span></li>
				<li>采纳率：<span><?php echo round($result['adopt']/$result['answer']);?>%</span></li>
			</ul>
		</div><?php endif; ?>
	<span class='star-name'>历史回答问题最多的人</span>
	<?php  $times = strtotime(date('Y-m-d')); $sql = "SELECT `uid`, count( * ) AS count  FROM dd_answer `answer`  GROUP BY `uid`  ORDER BY count DESC LIMIT 1 "; $result = M()->query($sql); $uid = $result[0]['uid']; $sqls = "SELECT `face`,`nickname`,`exp`,`answer`,`adopt`FROM `dd_user` `user` WHERE `user`.`uid` = $uid"; $result = M()->query($sqls); $result = $result[0]; ?>
	<div class='star-info'>
		<div>
			<a href="<?php echo U('Member/index',array('id'=>$uid));?>" class='star-face'>
				<img src="<?php if($result["face"]): ?>/Uploads/Face/<?php echo ($result['face']); else: ?>/Wenda/Public/Index/Images/noface.gif<?php endif; ?>" width='48px' height='48px' alt="头像站位"/>
			</a>
			<ul>
				<li><a href="<?php echo U('Member/index',array('id'=>$uid));?>"><?php echo ($result["nickname"]); ?></a></li>
				<i class='level lv<?php echo (exp_to_level($result["exp"])); ?>' title='Level <?php echo (exp_to_level($result["exp"])); ?>'></i>
			</ul>
		</div>
		<ul class='star-count'>
			<li>回答数：<span><?php echo ($result["answer"]); ?></span></li>
			<li>采纳率：<span><?php echo round($result['adopt']/$result['answer']);?>%</span></li>
		</ul>
	</div>
</div>
<div class='star-list'>
	<p class='title'>后盾问答助人光荣榜</p>
	<?php
 $sql = "SELECT `nickname`,`exp`,`answer`,`uid`FROM `dd_user` GROUP BY `nickname` ORDER BY `answer` DESC LIMIT 3"; $result = M()->query($sql); ?>
	<div>
		<ul class='ul-title'>
			<li>用户名</li>
			<li style='text-align:right;'>帮助过的人数</li>
		</ul>
		<ul class='ul-list'>
		<?php if(is_array($result)): foreach($result as $k=>$v): ?><li>
				<a href="<?php echo U('Member/index',array('id'=>$v['uid']));?>"><i class='rank r<?php echo ($k+1); ?>'></i><?php echo ($v["nickname"]); ?></a>
				<span><?php echo ($v["answer"]); ?></span>
			</li><?php endforeach; endif; ?>				
		</ul>
	</div>
</div>
</div>
<!-- ---右侧结束---- -->
			
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