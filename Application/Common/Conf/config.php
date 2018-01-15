<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'              => 'mysql',//数据库的类型
	'DB_HOST'              => 'localhost',//数据库的服务器地址
	'DB_NAME'              => 'chenxi',//数据库名
	'DB_USER'              => 'root',//账号
	'DB_PWD'               => 'root1209',//密码
	'DB_PORT'              => '3306',//数据库的端口号
	'DB_PREFIX'            => 'test_',//数据库的表前缀
	'MODULE_DENY_LIST'     => array('Common', 'Runtime'), //定义缓存的路径和公共函数的路径
	'MODULE_ALLOW_LIST'    => array('Home','Admin'),
	'DEFAULT_MODULE'       => 'Home',// 默认执行的模板
	'URL_MODEL'            => 2,  //执行重写url路径
	'URL_HTML_SUFFIX'      => 'html' ,//执行默认显示的页面的格式 
	'URL_CASE_INSENSITIVE'   => true, //表示URL区分大小写;
	//'TMPL_EXCEPTION_FILE' =>  './404.html',	//定义公共错误模板
);