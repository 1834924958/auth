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
					<div class="caption"><i class="icon-globe"></i>备份数据库</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="clearfix">
						<div class="btn-group">
							<a id="export" class="btn" href="javascript:;" autocomplete="off">
								<button id="sample_editable_1_new" class="btn green">
								立即备份&nbsp;&nbsp;<i class="icon-plus"></i>
								</button>
							</a>
						</div>
						<div class="btn-group">
							<a href="<?php echo U('Tools/optimize');?>" id="optimize" >
								<button id="sample_editable_1_new" class="btn blue">
									优化表&nbsp;&nbsp;<i class="icon-wrench"></i>
								</button>
							</a>
						</div>
						<div class="btn-group">
							<a href="<?php echo U('Tools/repair');?>" id="repair" >
								<button id="sample_editable_1_new" class="btn red">
									修复表&nbsp;&nbsp;<i class="icon-ambulance"></i>
								</button>
							</a>
						</div>
					</div>
					<form id="export-form" method="post" action="<?php echo U('Tools/export');?>">
						<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
								<tr>
									<th style="width:8px;"><input type="checkbox" class="check-all" checked="checked"/></th>
									<th>表名</th>
									<th class="hidden-480">数据量</th>
									<th class="hidden-480">数据大小</th>
									<th class="hidden-480">创建时间</th>
									<th>备份状态</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><tr class="odd gradeX">
									<td><input type="checkbox" class="ids" name = "tables[]" value="<?php echo ($table["name"]); ?>" checked="checked"/></td>
									<td><?php echo ($table["name"]); ?></td>
									<td class="hidden-480"><?php echo ($table["rows"]); ?></td>
									<td class="hidden-480"><?php echo ($table["data_length"]); ?></td>
									<td class="center hidden-480"><?php echo ($table["create_time"]); ?></td>
									<td class="info">未备份</td>
									<td>
										<a href="<?php echo U('Tools/excel?tables='.$table['name']);?>" class="btn mini purple"><i class="icon-share"></i>&nbsp;导出表</a>
										<a href="<?php echo U('Tools/optimize?tables='.$table['name']);?>" class="btn mini blue ajax-get"><i class="icon-wrench"></i>&nbsp;优化表</a>
										<a href="<?php echo U('Tools/repair?tables='.$table['name']);?>" class="btn mini red ajax-get"><i class="icon-ambulance"></i>&nbsp;修复表</a>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	(function($){
		var $form=$("#export-form"),$export=$("#export"),tables
		$optimize=$("#optimize"),$repair=$("#repair");
		$optimize.add($repair).click(function(){
			$.post(this.href,$form.serialize(),function(data){
				if(data.status){
					updateAlert(data.info,'alert-success');
				}else{
					updateAlert(data.info,'alert-error');
				}
				setTimeout(function(){
					$('#top-alert').find('button').click();
					$(that).removeClass('disabled').prop('disabled',false);
				},1500);
			},"json");
			return false;
		});
		$export.click(function(){
			$export.parent().children().addClass("disabled");
			$export.html("正在发送备份请求...");
			$.post($form.attr("action"),$form.serialize(),function(data){
				if(data.status){
					tables=data.tables;
					$export.html(data.info+"开始备份，请不要关闭本页面！");
					backup(data.tab);
					window.onbeforeunload=function(){
						return "正在备份数据库，请不要关闭！"
					}
				}else{
					updateAlert(data.info,'alert-error');
					$export.parent().children().removeClass("disabled");
					$export.html("立即备份");
					setTimeout(function(){
						$('#top-alert').find('button').click();
						$(that).removeClass('disabled').prop('disabled',false);
					},1500);
				}
			},"json");
			return false;
		});
		function backup(tab,status){
			status&&showmsg(tab.id,"开始备份...(0%)");
			$.get($form.attr("action"),tab,function(data){
				if(data.status){
					//alert(tab.id + '|' +data.info);
					showmsg(tab.id,data.info);
					if(!$.isPlainObject(data.tab)){
						$export.parent().children().removeClass("disabled");
						$export.html("备份完成，点击重新备份");
						window.onbeforeunload=function(){
							return null
						}
						return;
					}
					backup(data.tab,tab.id!=data.tab.id);
				}else{
					updateAlert(data.info,'alert-error');
					$export.parent().children().removeClass("disabled");
					$export.html("立即备份");
					setTimeout(function(){
						$('#top-alert').find('button').click();
						$(that).removeClass('disabled').prop('disabled',false);
					},1500);
				}
			},"json");
		}
		function showmsg(id,msg){
			$form.find("input[value="+tables[id]+"]").closest("tr").find(".info").html(msg);
		}
	})(jQuery);
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