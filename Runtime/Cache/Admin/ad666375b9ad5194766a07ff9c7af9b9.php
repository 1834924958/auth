<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8" />
	<title>后台管理系统</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<!--开始全局强制样式 -->
	<link href="/asdf/Public/Admin/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="/asdf/Public/Admin/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="/asdf/Public/Admin/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/asdf/Public/Admin/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="/asdf/Public/Admin/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="/asdf/Public/Admin/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="/asdf/Public/Admin/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="/asdf/Public/Admin/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- 结束全局强制样式 -->
	<!-- 开始页面级别样式 --> 
	<link href="/asdf/Public/Admin/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
	<link href="/asdf/Public/Admin/css/daterangepicker.css" rel="stylesheet" type="text/css" />
	<link href="/asdf/Public/Admin/css/fullcalendar.css" rel="stylesheet" type="text/css"/>
	<link href="/asdf/Public/Admin/css/quan.css" rel="stylesheet" type="text/css"/>
	<link href="/asdf/Public/Admin/css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
	<!-- 结束页面级别样式 -->
	<link rel="shortcut icon" href="/asdf/Public/Admin/images/as.jpg" />
	<!-- 开始Javascript（底部，加载javascript这将减少页面加载时间） -->
	<!-- 从核心插件 -->
	<script type="text/javascript" src="/asdf/Public/Admin/js/jquery.min.js"></script>
	<script type="text/javascript" src="/asdf/Public/Admin/js/quan.js"></script>
	<script type="text/javascript" src="/asdf/Public/layer/layer.js"></script>
	<script type="text/javascript" src="/asdf/Public/layer/laydate/laydate.js"></script>
	<script src="/asdf/Public/Admin/js/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="/asdf/Public/Admin/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- 重要！前负荷jquery-ui-1.10.1.custom.min.js bootstrap.min.js修复引导提示冲突与jQuery UI工具提示 -->
	<script src="/asdf/Public/Admin/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="/asdf/Public/Admin/js/bootstrap.min.js" type="text/javascript"></script>  
	<script src="/asdf/Public/Admin/js/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="/asdf/Public/Admin/js/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="/asdf/Public/Admin/js/jquery.cookie.min.js" type="text/javascript"></script>
	<!-- 结束核心插件 -->
	<!-- 开始页面级插件 -->
	<script src="/asdf/Public/Admin/js/jquery.flot.js" type="text/javascript"></script>
	<script src="/asdf/Public/Admin/js/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="/asdf/Public/Admin/js/jquery.pulsate.min.js" type="text/javascript"></script>
	<script src="/asdf/Public/Admin/js/date.js" type="text/javascript"></script>
	<script src="/asdf/Public/Admin/js/daterangepicker.js" type="text/javascript"></script>     
	<script src="/asdf/Public/Admin/js/jquery.gritter.js" type="text/javascript"></script>
	<script src="/asdf/Public/Admin/js/fullcalendar.min.js" type="text/javascript"></script>
	<script src="/asdf/Public/Admin/js/jquery.easy-pie-chart.js" type="text/javascript"></script>
	<script src="/asdf/Public/Admin/js/jquery.sparkline.min.js" type="text/javascript"></script>  
	<!-- 结束页面级插件 -->
	<!-- 开始页面级脚本 -->
	<script src="/asdf/Public/Admin/js/app.js" type="text/javascript"></script>
	<script src="/asdf/Public/Admin/js/index.js" type="text/javascript"></script>        
	<!-- 结束页级脚本 -->  
</head>
<body class="page-header-fixed">
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="index.html">
					<img src="/asdf/Public/Admin/images/as.jpg" alt="logo" style="width:60px;height:30px;"/>
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
							<img alt="" src="/asdf/Public/Admin/image/avatar1_small.jpg" />
							<span class="username">&nbsp;<?php echo session('admin_username');?></span>
							<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/asdf/" target="_bank"><i class="icon-user"></i>&nbsp;前台首页</a></li>
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
	<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
		<div class="dashboard-stat blue">
			<div class="visual">
				<i class="icon-comments"></i>
			</div>
			<div class="details">
				<div class="number">
					1349
				</div>
				<div class="desc">
					New Feedbacks
				</div>
			</div>
			<a class="more" href="#">
				View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
		<div class="dashboard-stat green">
			<div class="visual">
				<i class="icon-shopping-cart"></i>
			</div>
			<div class="details">
				<div class="number">549</div>
				<div class="desc">New Orders</div>
			</div>
			<a class="more" href="#">
				View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
		<div class="dashboard-stat purple">
			<div class="visual">
				<i class="icon-globe"></i>
			</div>
			<div class="details">
				<div class="number">+89%</div>
				<div class="desc">Brand Popularity</div>
			</div>
			<a class="more" href="#">
				View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
		<div class="dashboard-stat yellow">
			<div class="visual">
				<i class="icon-bar-chart"></i>
			</div>
			<div class="details">
				<div class="number">12,5M$</div>
				<div class="desc">Total Profit</div>
			</div>
			<a class="more" href="#">
				View more <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</div>
	</div>
	<div class="tab-pane ">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption"><i class="icon-reorder"></i>系统概览</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-horizontal form-view">
					<h3 class="form-section">基本信息</h3>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >系统版本:</label>
								<div class="controls">
									<span class="text">正版授权</span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label">服务器操作系统:</label>
								<div class="controls">
									<span class="text"><?php echo (PHP_OS); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >运行环境:</label>
								<div class="controls">
									<span class="text"><?php echo ($_SERVER['SERVER_SOFTWARE']); ?></span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >PHP版本:</label>
								<div class="controls">
									<span class="text"><?php echo (PHP_VERSION); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >PHP运行方式:</label>
								<div class="controls">
									<span class="text"><?php echo ($phpModel); ?></span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >ThinkPHP版本:</label>
								<div class="controls">
									<span class="text"><?php echo (THINK_VERSION); ?>&nbsp;&nbsp;<a href="http://www.thinkphp.cn/" target="_blank"  style="text-decoration: none;">[查看最新版本]</a></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >上传附件限制:</label>
								<div class="controls">
									<span class="text"><?php echo ($fileLimit); ?></span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >执行时间限制:</label>
								<div class="controls">
									<span class="text"><?php echo ($etimeLimit); ?>&nbsp;秒</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >剩余空间:</label>
								<div class="controls">
									<span class="text"><?php echo ($Rspace); ?></span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >register_globals:</label>
								<div class="controls">
									<span class="text"><?php echo ($Variable); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >magic_quotes_gpc:</label>
								<div class="controls">
									<span class="text"><?php echo ($jiexi); ?></span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >magic_quotes_runtime:</label>
								<div class="controls">
									<span class="text"><?php echo ($zhuanyi); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >Mysql版本:</label>
								<div class="controls">
									<span class="text"><?php echo ($arr['mysql']['0']['v']); ?></span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >服务器IP:</label>
								<div class="controls"><span class="text"><?php echo ($_SERVER['SERVER_ADDR']); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >你的IP:</label>
								<div class="controls">
									<span class="text"><?php echo ($_SERVER['REMOTE_ADDR']); ?></span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >服务器端口:</label>
								<div class="controls"><span class="text"><?php echo ($_SERVER['SERVER_PORT']); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >绝对路径:</label>
								<div class="controls">
									<span class="text"><?php echo ($_SERVER['DOCUMENT_ROOT']); ?></span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >授权域名:</label>
								<div class="controls"><span class="text"><?php echo ($_SERVER['HTTP_HOST']); ?></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >授权周期:</label>
								<div class="controls">
									<span class="text">终身</span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >售后周期:</label>
								<div class="controls"><span class="text">一年</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >网站域名:</label>
								<div class="controls">
									<span class="text"><?php echo ($_SERVER['SERVER_NAME']); ?></span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >官方网址：</label>
								<div class="controls"><span class="text"><a href="#" style="text-decoration:none;"><?php echo ($_SERVER['SERVER_NAME']); ?></a></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >版权所有:</label>
								<div class="controls">
									<span class="text"><a href="#" style="text-decoration:none;">网站名</a
									>&nbsp;&nbsp;版权所有,未经许可,请勿传播</span>
								</div>
							</div>
						</div>
						<div class="span6 ">
							<div class="control-group">
								<label class="control-label" >风险警告：</label>
								<div class="controls"><span class="text">为保障程序的正常运行,请勿随意篡改代码!</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


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