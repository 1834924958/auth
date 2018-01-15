<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8" />
	<title>后台管理系统</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<!--开始全局强制样式 -->
	<link href="/Public/Admin/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/Admin/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/Admin/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/Admin/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/Admin/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/Admin/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="/Public/Admin/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- 结束全局强制样式 -->
	<!-- 开始页面级别样式 --> 
	<link href="/Public/Admin/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/Admin/css/daterangepicker.css" rel="stylesheet" type="text/css" />
	<link href="/Public/Admin/css/fullcalendar.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/Admin/css/quan.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/Admin/css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
	<!-- 结束页面级别样式 -->
	<link rel="shortcut icon" href="/Public/Admin/images/as.jpg" />
	<!-- 开始Javascript（底部，加载javascript这将减少页面加载时间） -->
	<!-- 从核心插件 -->
	<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
	<script type="text/javascript" src="/Public/Admin/js/quan.js"></script>
	<script type="text/javascript" src="/Public/layer/layer.js"></script>
	<script type="text/javascript" src="/Public/layer/laydate/laydate.js"></script>
	<script src="/Public/Admin/js/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="/Public/Admin/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- 重要！前负荷jquery-ui-1.10.1.custom.min.js bootstrap.min.js修复引导提示冲突与jQuery UI工具提示 -->
	<script src="/Public/Admin/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="/Public/Admin/js/bootstrap.min.js" type="text/javascript"></script>  
	<script src="/Public/Admin/js/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="/Public/Admin/js/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="/Public/Admin/js/jquery.cookie.min.js" type="text/javascript"></script>
	<!-- 结束核心插件 -->
	<!-- 开始页面级插件 -->
	<script src="/Public/Admin/js/jquery.flot.js" type="text/javascript"></script>
	<script src="/Public/Admin/js/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="/Public/Admin/js/jquery.pulsate.min.js" type="text/javascript"></script>
	<script src="/Public/Admin/js/date.js" type="text/javascript"></script>
	<script src="/Public/Admin/js/daterangepicker.js" type="text/javascript"></script>     
	<script src="/Public/Admin/js/jquery.gritter.js" type="text/javascript"></script>
	<script src="/Public/Admin/js/fullcalendar.min.js" type="text/javascript"></script>
	<script src="/Public/Admin/js/jquery.easy-pie-chart.js" type="text/javascript"></script>
	<script src="/Public/Admin/js/jquery.sparkline.min.js" type="text/javascript"></script>  
	<!-- 结束页面级插件 -->
	<!-- 开始页面级脚本 -->
	<script src="/Public/Admin/js/app.js" type="text/javascript"></script>
	<script src="/Public/Admin/js/index.js" type="text/javascript"></script>        
	<!-- 结束页级脚本 -->  
</head>
<body class="page-header-fixed">
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="index.html">
					<img src="/Public/Admin/images/as.jpg" alt="logo" style="width:60px;height:30px;"/>
				</a>
				<!--开始执行主导航--->
				<ul class="nav pull-left">
					<?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="dropdown" id="header_notification_bar" <?php if(($menu["class"]) == "current"): ?>class="active"<?php endif; ?>>
							<a href="<?php echo (U($menu["url"])); ?>" class="dropdown-toggle">
								<?php if(empty($menu["ico_name"])): ?><i class="icon-tag"></i>
								<?php else: ?>
									<i class="<?php echo ($menu["ico_name"]); ?>"></i><?php endif; ?>
								<span>&nbsp;<?php echo ($menu["title"]); ?>&nbsp;</span>&nbsp;
							</a>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<!--主导航执行结束--->
				<ul class="nav pull-right">
					<!-- 开始用户登录下拉菜单 -->
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img alt="" src="/Public/Admin/image/avatar1_small.jpg" />
							<span class="username">&nbsp;<?php echo session('admin_username');?></span>
							<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/" target="_bank"><i class="icon-user"></i>&nbsp;前台首页</a></li>
							<li><a href="<?php echo U('Tools/clean');?>"><i class="icon-trash"></i>&nbsp;清除缓存</a></li>
							<li><a href="<?php echo U('User/setpwd');?>"><i class="icon-pencil"></i>&nbsp;修改密码</a></li>
							<li class="divider"></li>
							<li><a href="javascript:void(0);" onclick="lockscreen()"><i class="icon-lock"></i>&nbsp;锁屏休息</a></li>
							<li><a href="<?php echo U('Login/loginout');?>"><i class="icon-key"></i>&nbsp;退出后台</a></li>
						</ul>
					</li>
					<!-- 用户登录下拉框结束 -->
				</ul>		
			</div>
		</div>
	</div>
	<div class="page-container">
		<div class="page-sidebar nav-collapse collapse">     
			<ul class="page-sidebar-menu">
				<li>
					<div class="sidebar-toggler hidden-phone"></div>
				</li>
				<li>
					<!-- 开始响应快速搜索表单-->
					<form class="sidebar-search">
						<div class="input-box">
							<a href="javascript:;" class="remove"></a>
							<input type="text" placeholder="搜索..." />
							<input type="button" class="submit" value=" " />
						</div>
					</form>
				</li>
				<li class="start active ">
					<a href="#">
						<i class="icon-home"></i> 
						<span class="title">Dashboard</span>
						<span class="selected"></span>
					</a>
				</li>
				<!---开始子导航--->
				<?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><li class="">
						<a href="javascript:;">
								<i class="icon-plus"></i> 
							<?php if(!empty($key)): ?><span class="title"><?php echo ($key); ?></span><?php endif; ?>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
									<a href="<?php echo (U($menu["url"])); ?>">
										<?php if(empty($menu["ico_name"])): ?><i class="icon-user"></i>
											<?php else: ?>
											<i class="<?php echo ($menu["ico_name"]); ?>"></i><?php endif; ?>
										&nbsp;<?php echo ($menu["title"]); ?>
									</a>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>
				<!---子导航结束--->
			</ul>
			<!-- 结束侧边栏菜单 -->
		</div>
		<div class="page-content">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">   
						<!-- 开始页面的标题和面包屑-->
						<h3 class="page-title">
							欢迎 <small>进入后台管理</small>
							<small style="margin-left:1100px;" id="time"></small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.html">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Dashboard</a></li>
						</ul>
					</div>
				</div>
				<div id="dashboard">


<div class="row-fluid">
	<div class="span12">
		<div id="top-alert" class="fixed alert alert-error" style="display: none;">
			<button class="close fixed" style="margin-top: 4px;">&times;</button>
			<div class="alert-content">警告内容</div>
		</div>
		<div id="main" class="main">
			<div class="portlet box blue">
				<div class="portlet-title">
					<a href="<?php echo U('Article/links');?>" style="color:white;">
						<div class="caption"><i class="icon-reorder"></i>友情链接管理</div>
					</a>
					<div class="caption">
						<?php if(empty($data)): ?>&nbsp;&nbsp;友情链接添加
						<?php else: ?>
							&nbsp;&nbsp;友情链接编辑<?php endif; ?>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body form">
					<form action="<?php echo U('Article/linksEdit');?>" method ="POST" id="form" class="form-horizontal">
						<?php if(empty($data["id"])): else: ?>
							<div class="control-group">
								<label class="control-label">友情链接的ID</label>
								<div class="controls">
									<input class="span6 m-wrap" type="text" name="id" value="<?php echo ($data["id"]); ?>" disabled />
									<span class="help-inline" style="color:red;">*&nbsp;ID不可以进行更改.</span>
								</div>
							</div><?php endif; ?>
						<div class="control-group">
							<label class="control-label">链接名称：</label>
							<div class="controls">
								<input type="text" name="name" value="<?php echo ($data["name"]); ?>" class="span6 m-wrap popovers" data-trigger="hover" data-content="*&nbsp;对链接的介绍."/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">链接标题：</label>
							<div class="controls">
								<input type="text" name="title" value="<?php echo ($data["title"]); ?>" class="span6 m-wrap popovers" data-trigger="hover" data-content="*&nbsp;一般显示在前台中."/>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">链接地址：</label>
							<div class="controls">
								<input type="text" name="url" value="<?php echo ($data["url"]); ?>" class="span6 m-wrap popovers" data-trigger="hover" data-content="*&nbsp;链接的URL地址."/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">添加时间：</label>
							<div class="controls">
								<input name="addtime" type="text" value="<?php echo (addtime($data['addtime'])); ?>" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  class="span6 m-wrap popovers" data-trigger="hover" data-content="*&nbsp;往数据表中添加数据显示的时间."/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">编辑时间：</label>
							<div class="controls">
								<input name="endtime" type="text" value="<?php echo (addtime($data['endtime'])); ?>" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  class="span6 m-wrap popovers" data-trigger="hover" data-content="*&nbsp;对已有的数据进行修改的时间."/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">排序：</label>
							<div class="controls">
								<input type="text" name="sort" value="<?php echo ($data["sort"]); ?>" class="span6 m-wrap popovers" data-trigger="hover" data-content="*&nbsp;不同的值在前台页面中显示不同的位置."/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">状态：</label>
							<div class="controls">
								<select name="status" class="span6  m-wrap popovers" data-placeholder="Choose a Category" data-trigger="hover" data-content="*&nbsp;不同的状态值代表不同的操作.">
									<option value="1" <?php if(($data["status"]) == "1"): ?>selected<?php endif; ?>>正常</option>
									<option value="0" <?php if(($data["status"]) == "0"): ?>selected<?php endif; ?>>冻结</option>
								</select>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" id="submit" class="btn blue ajax-post" target-form="form-horizontal">确认</button>
							<a class="btn-return" href="<?php echo ($_SERVER['HTTP_REFERER']); ?>"><button type="button" class="btn">取消</button></a>
							<?php if(!empty($data["id"])): ?><input type="hidden" name="id" value="<?php echo ($data["id"]); ?>"/><?php endif; ?>                            
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	//执行提交表单的操作
	$('#submit').click(function(){
		$('#form').submit();
	});
</script>


				</div>
			</div>
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
<script type="text/javascript">
	+function(){
		layer.config({
			extend: 'extend/layer.ext.js'
		});
	}();
	function lockscreen(){
		layer.prompt({
			title: '输入一个锁屏密码',
			formType: 1,
			btn: ['锁屏','取消'] //按钮
		}, function(pass){
			if(!pass){
				layer.msg('需要输入一个密码!');
			}else{
				$.post("<?php echo U('Login/lockScreen');?>",{pass:pass},function(data){
					layer.msg(data.info);
					layer.close();
					if(data.status){
						window.location.href = "<?php echo U('Login/lockScreen');?>";
					}
				},'json');
			}
		});
	}
</script>
<script type="text/javascript">  
	change();  
	function change()  
	{  
		var today;  
		today = new Date();  
		timeString = today.toLocaleString();  
		document.getElementById("time").innerHTML = timeString;  
		setTimeout("change();", 1000);  
	}  
</script> 
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		   Index.init();
		   Index.initCalendar(); // init index page's custom scripts
		   Index.initCharts(); // init index page's custom scripts
		   Index.initChat();
		   Index.initMiniCharts();
		   Index.initDashboardDaterange();
		   Index.initIntro();
		});
	</script>
</body>
</html>