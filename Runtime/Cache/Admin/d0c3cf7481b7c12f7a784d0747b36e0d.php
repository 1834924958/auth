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
		<div class="portlet box light-grey">
			<div class="portlet-title">
				<div class="caption"><i class="icon-globe"></i>权限管理</div>
				<div class="tools">
					<a href="javascript:;" class="collapse"></a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="clearfix">
					<a href="<?php echo U('User/authEdit');?>">
					<div class="btn-group">
						<button id="sample_editable_1_new" class="btn green">
						新增&nbsp;&nbsp;<i class="icon-plus"></i>
						</button>
					</div>
					</a>
					<div class="btn-group">
						<button id="sample_editable_1_new" url="<?php echo U('User/authStatus',array('type'=>'forbid'));?>" class="btn red ajax-post btn-warning" target-form="ids">
						禁用&nbsp;&nbsp;<i class="icon-lock"></i>
						</button>
					</div>
					<div class="btn-group">
						<button id="sample_editable_1_new" url="<?php echo U('User/authStatus',array('type'=>'resume'));?>" class="btn green ajax-post btn-info" target-form="ids">
						启用&nbsp;&nbsp;<i class="icon-unlock"></i>
						</button>
					</div>
					<div class="btn-group">
						<button id="sample_editable_1_new" url="<?php echo U('User/authStatus',array('type'=>'del'));?>" class="btn red ajax-post confirm btn-danger" target-form="ids">
						删除&nbsp;&nbsp;<i class="icon-trash"></i>
						</button>
					</div>
					<div class="btn-group">
						<button id="sample_editable_1_new" url="<?php echo U('User/authStart');?>" class="btn blue ajax-post confirm btn-primary" target-form="ids">
						重新初始化权限&nbsp;&nbsp;<i class=" icon-truck"></i>
						</button>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover" id="sample_1">
					<thead>
						<tr>
							<th class="row-selected row-selected"><input class="check-all" type="checkbox"/></th>
							<th>用户组</th>
							<th class="hidden-480">描述</th>
							<th class="hidden-480">授权</th>
							<th class="hidden-480">状态</th>
							<th >操作</th>
						</tr>
					</thead>
					<tbody>
					<?php if(!empty($_list)): if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeX">
							<td><input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"/></td>
							<td><?php echo ($vo["title"]); ?></td>
							<td class="hidden-480"><?php echo ($vo["description"]); ?></td>
							<td class="hidden-480">
								<a href="<?php echo U('User/authAccess?group_name='.$vo['title'].'&group_id='.$vo['id']);?>" class="btn mini blue">&nbsp;访问授权</a>
								<a href="<?php echo U('User/authUser?group_name='.$vo['title'].'&group_id='.$vo['id']);?>" class="btn mini yellow">&nbsp;成员授权</a>
							</td>
							<td class="center hidden-480">
								<?php if(($vo["status"]) == "0"): ?><span class="label label-inverse"><?php echo ($vo["status_text"]); ?></span><?php endif; ?>
								<?php if(($vo["status"]) == "1"): ?><span class="label label-success"><?php echo ($vo["status_text"]); ?></span><?php endif; ?>
							</td>
							<td ><a href="<?php echo U('User/authEdit?id='.$vo['id']);?>" class="btn mini purple"><i class="icon-edit"></i>&nbsp;编辑</a></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
						<td colspan="12" class="text-center" style="text-align:center;color:red;">Oh! 暂时还没有内容!</td><?php endif; ?>
					</tbody>
				</table>
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