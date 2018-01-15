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
	<div class="span12">
		<div id="top-alert" class="fixed alert alert-error" style="display: none;">
			<button class="close fixed" style="margin-top: 4px;">&times;</button>
			<div class="alert-content">警告内容</div>
		</div>
		<div id="main" class="main">
			<div class="portlet box light-grey">
				<div class="portlet-title">
					<a href="<?php echo U('User/auth');?>" style="color:white;"><div class="caption"><i class="icon-globe"></i>权限管理</div></a>
					<div class="caption">&nbsp;&nbsp;访问授权</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="clearfix">
						<div class="btn-group">
							<button id="sample_editable_1_new" class="btn green">
							访问授权&nbsp;<i class="icon-legal"></i>
							</button>						
						</div>		
						<select class="medium m-wrap select" tabindex="1" name="group">
							<?php if(is_array($auth_group)): $i = 0; $__LIST__ = $auth_group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo U('User/authAccess',array('group_id' => $vo['id'],'group_name' =>$vo['title']));?>" <?php if(($vo['id']) == $this_group['id']): ?>selected<?php endif; ?>><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
				<!--剔除的一些内容--->
				<div class="portlet box">	
					<div class="portlet-body form">
						<form action="<?php echo U('User/authAccessUp');?>" class="form-horizontal auth-form" method="POST">
							<?php if(is_array($node_list)): $i = 0; $__LIST__ = $node_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><dl>
									<dt>
										<div class="breadcrumb"><input type="checkbox" class="auth_rules rules_all" name="rules[]" style="margin-top:-4px;" value="<?php echo $main_rules[$node['url']]?>" />&nbsp;<?php echo ($node["title"]); ?>管理</div>
									</dt>
									<dd>
										<?php if(isset($node['child'])): if(is_array($node['child'])): $i = 0; $__LIST__ = $node['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$child): $mod = ($i % 2 );++$i;?><div class="control-group">
													<input type="checkbox"  class="auth_rules" name="rules[]" value="<?php echo $auth_rules[$child['url']]?>" style="margin-top:-4px;"/>&nbsp;<?php echo ($child["title"]); ?>
													<span class="divsion" style="margin-left:30px;">&nbsp;&nbsp;</span>
													<?php if(is_array($child['operator'])): $i = 0; $__LIST__ = $child['operator'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$op): $mod = ($i % 2 );++$i;?><input type="checkbox" class="auth_rules" name="rules[]" value="<?php echo $auth_rules[$op['url']] ?>"  style="margin-top:-4px;margin-left:20px;"/>&nbsp;<?php echo ($op["title"]); endforeach; endif; else: echo "" ;endif; ?>
												</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
									</dd>
								</dl><?php endforeach; endif; else: echo "" ;endif; ?>
							<input type="hidden" name="id" value="<?php echo ($this_group["id"]); ?>"/>
							<div class="form-actions">
								<button type="submit" class="btn blue submit-btn ajax-post" target-form="auth-form">确认</button>
								<button type="button" class="btn btn-return" onclick="javascript:history.back(-1);return false;">取消</button>                            
							</div>
						</form>
					</div>
				</div>				
				<!----剔除内容结束--->
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	+function($){
		var rules = [<?php echo ($this_group["rules"]); ?>];
		$('.auth_rules').each(function(){
			if($.inArray(parseInt(this.value,10),rules) > -1){
				$(this).prop('checked',true);
			}
			if(this.value == ''){
				$(this).closest('span').remove();
			}
		});
		//全选节点
		$('.rules_all').on('change', function () {
			$(this).closest('dl').find('dd').find('input').prop('checked', this.checked);
		});
		//分级搜索
		$('select[name=group]').change(
			function(){
				location.href = this.value;
			}
		);
	}(jQuery);
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