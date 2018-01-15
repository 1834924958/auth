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
			<div class="portlet box light-grey">
				<div class="portlet-title">
					<div class="caption"><i class="icon-globe"></i>友情链接</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="clearfix">
						<div class="btn-group">
							<a href="<?php echo U('Article/linksEdit');?>">
								<button id="sample_editable_1_new" class="btn green">
								新增&nbsp;&nbsp;<i class="icon-plus"></i>
								</button>
							</a>
						</div>
						<div class="btn-group">
							<button id="sample_editable_1_new" class="btn red ajax-post btn-warning" url="<?php echo U('Article/linkStatus',array('type'=>'forbid'));?>" target-form="ids">
							禁用&nbsp;&nbsp;<i class="icon-lock"></i>
							</button>
						</div>
						<div class="btn-group">
							<button id="sample_editable_1_new" class="btn green ajax-post btn-info" url="<?php echo U('Article/linkStatus',array('type'=>'resume'));?>" target-form="ids">
							启用&nbsp;&nbsp;<i class="icon-unlock"></i>
							</button>
						</div>
						<div class="btn-group">
							<button id="sample_editable_1_new" class="btn red ajax-post confirm btn-danger" url="<?php echo U('Article/linkStatus',array('type'=>'del'));?>" target-form="ids">
							删除&nbsp;&nbsp;<i class="icon-trash"></i>
							</button>
						</div>
						<!--执行搜索功能-->
						<div class="btn-group pull-right">
							<form name="formSearch" id="formSearch" method="get" class="btn-group pull-right">
								<div class="btn-group pull-right" id="sample_1_filter">
									<select style="width: 160px; height:34px;float: left; margin-right: 10px;" name="status" class="form-control">
										<option value=""
										<?php if(empty($_GET['status'])): ?>selected<?php endif; ?>
										>全部状态</option>
										<option value="1"
										<?php if(($_GET['status']) == "1"): ?>selected<?php endif; ?>
										>冻结状态</option>
										<option value="2"
										<?php if(($_GET['status']) == "2"): ?>selected<?php endif; ?>
										>正常状态</option>
									</select>
									<select style=" width: 160px; height:34px; float: left; margin-right: 10px;" name="field" class="form-control">
										<option value="name"
										<?php if(empty($_GET['field'])): ?>selected<?php endif; ?>
										>链接名称</option>
										<option value="url"
										<?php if(empty($_GET['field'])): ?>selected<?php endif; ?>
										>链接地址</option>
										<option value="id"
										<?php if(($_GET['field']) == "id"): ?>selected<?php endif; ?>
										>链接ID</option>
									</select>
									<input type="text"  class="m-wrap medium  search-input form-control" name="name" placeholder="请输入查询的内容" value="<?php echo ($_GET['name']); ?>" />
									<a href="javascript:;" id="search" style="margin-right:10px;">
										<span class="input-group-btn">
											<button type="submit" class="btn btn-xs  btn-purple">
												<span class="ace-icon fa fa-search icon-on-right bigger-110">
												</span>
												<i class="icon-search"></i>&nbsp;搜索
											</button>
										</span>
									</a>
									<a href="<?php echo U('Article/links');?>">
										<button type="button" class="btn btn-xs  btn-purple">
										<span class="ace-icon fa fa-globe icon-on-right bigger-110">
										</span>
										<i class="icon-chevron-down"></i>&nbsp;显示全部
										</button>
									</a>
								</div>
							</form>
							<script type="text/javascript">
								//执行搜索的功能
								$(function () {
									$('#search').click(function () {
										$('#formSearch').submit();
									});
								});
								//回车搜索
								$(".search-input").keyup(function (e) {
									if (e.keyCode === 13) {
										$("#search").click();
										return false;
									}
								});
							</script>
						</div>	
						<!---搜索功能结束---->
					</div>
					<table class="table table-striped table-bordered table-hover" id="sample_1">
						<thead>
							<tr>
								<th class="row-selected row-selected">
									<input class="check-all" type="checkbox"/>
								</th>
								<th>ID</th>
								<th>链接名称</th>
								<th class="hidden-480">链接标题</th>
								<th class="hidden-480">链接地址</th>
								<th class="hidden-480">添加时间</th>
								<th class="hidden-480">编辑时间</th>
								<th class="hidden-480">排序</th>
								<th class="hidden-480">状态</th>
								<th >操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="odd gradeX">
										<td>
											<input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"/>
										</td>
										<td><?php echo ($vo["id"]); ?></td>
										<td><?php echo ($vo["name"]); ?></td>
										<td><?php echo ($vo["title"]); ?></td>
										<td><?php echo ($vo["url"]); ?></td>
										<td class="hidden-480"><?php echo (addtime($vo["addtime"])); ?></td>
										<td class="hidden-480"><?php echo (addtime($vo["endtime"])); ?></td>
										<td><?php echo ($vo["sort"]); ?></td>
										<td >
											<?php if(($vo["status"]) == "0"): ?><span class="label label-danger"><i class="icon-lock"></i>&nbsp;禁用</span><?php endif; ?>
											<?php if(($vo["status"]) == "1"): ?><span class="label label-success"><i class="icon-unlock"></i>&nbsp;启用</span><?php endif; ?>
										</td>
										<td ><a href="<?php echo U('Article/linksEdit?id='.$vo['id']);?>" class="btn mini purple"><i class="icon-edit"></i>&nbsp;编辑</a></td>
									</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							<?php else: ?>
								<td colspan="12" class="text-center" style="text-align:center;color:red;">Oh! 暂时还没有内容!</td><?php endif; ?>
						</tbody>
					</table>
					<div class="page">
						<div><?php echo ($page); ?></div>
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