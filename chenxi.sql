/*
Navicat MySQL Data Transfer

Source Server         : 本地连接
Source Server Version : 100119
Source Host           : localhost:3306
Source Database       : chenxi

Target Server Type    : MYSQL
Target Server Version : 100119
File Encoding         : 65001

Date: 2018-01-15 16:47:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for test_admin
-- ----------------------------
DROP TABLE IF EXISTS `test_admin`;
CREATE TABLE `test_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员表',
  `username` varchar(50) NOT NULL COMMENT '管理员的用户名，一般限制在6位之间',
  `emial` varchar(100) NOT NULL COMMENT '管理员的邮箱，便于联系',
  `nickname` varchar(100) NOT NULL COMMENT '管理员的昵称(一般为真实姓名)',
  `mobile` int(11) NOT NULL COMMENT '管理员的手机号',
  `password` varchar(255) NOT NULL COMMENT '管理员的登录密码(一般是为MD5加密)',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '不同的状态值代表不同的操作',
  PRIMARY KEY (`id`),
  KEY `username` (`username`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_admin
-- ----------------------------
INSERT INTO `test_admin` VALUES ('1', 'admin123', '', 'DH', '0', '0192023a7bbd73250516f069df18b500', '1');
INSERT INTO `test_admin` VALUES ('2', 'admin1234', '', '晨曦', '0', '0192023a7bbd73250516f069df18b500', '1');
INSERT INTO `test_admin` VALUES ('3', 'admin11', '', '', '0', '', '0');

-- ----------------------------
-- Table structure for test_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `test_admin_log`;
CREATE TABLE `test_admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员登录日志表',
  `uid` int(11) unsigned NOT NULL COMMENT '管理员的id',
  `loginip` varchar(50) NOT NULL COMMENT '管理员登录的IP',
  `logintime` int(11) NOT NULL COMMENT '管理员最新登录的时间',
  `status` tinyint(4) NOT NULL COMMENT '不同的状态值代表不同的操作',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_admin_log
-- ----------------------------
INSERT INTO `test_admin_log` VALUES ('1', '1', '0.0.0.0', '1515987179', '0');
INSERT INTO `test_admin_log` VALUES ('2', '1', '0.0.0.0', '1515987273', '0');
INSERT INTO `test_admin_log` VALUES ('3', '1', '127.0.0.1', '1515987992', '0');
INSERT INTO `test_admin_log` VALUES ('4', '1', '127.0.0.1', '1515988394', '0');
INSERT INTO `test_admin_log` VALUES ('5', '1', '127.0.0.1', '1515991358', '0');
INSERT INTO `test_admin_log` VALUES ('6', '2', '127.0.0.1', '1515997027', '0');
INSERT INTO `test_admin_log` VALUES ('7', '1', '0.0.0.0', '1516000835', '0');
INSERT INTO `test_admin_log` VALUES ('8', '1', '127.0.0.1', '1516000880', '0');

-- ----------------------------
-- Table structure for test_adver
-- ----------------------------
DROP TABLE IF EXISTS `test_adver`;
CREATE TABLE `test_adver` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告管理表',
  `name` varchar(100) NOT NULL COMMENT '图片名称',
  `url` varchar(255) NOT NULL COMMENT '图片的URL链接',
  `img` varchar(255) NOT NULL COMMENT '图片名',
  `sort` int(11) NOT NULL COMMENT '图片排序',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `endtime` int(11) NOT NULL COMMENT '编辑时间',
  `status` tinyint(4) NOT NULL COMMENT '不同的状态值代表不同的操作',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_adver
-- ----------------------------
INSERT INTO `test_adver` VALUES ('1', 'chenix', 'https://www.baidu.com/', '5a5c5d9d38658.jpg', '0', '1516002722', '1516002721', '1');

-- ----------------------------
-- Table structure for test_article
-- ----------------------------
DROP TABLE IF EXISTS `test_article`;
CREATE TABLE `test_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章表',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文章内容',
  `adminid` int(11) unsigned NOT NULL COMMENT '后台哪个管理员发布文章',
  `type` varchar(100) NOT NULL COMMENT '文章隶属于上级哪个分区',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `endtime` int(11) NOT NULL COMMENT '编辑时间',
  `sort` int(11) NOT NULL COMMENT '文章排序',
  `status` tinyint(4) NOT NULL COMMENT '不同的状态值代表不同的操作',
  PRIMARY KEY (`id`),
  KEY `type` (`type`) USING BTREE,
  KEY `adminid` (`adminid`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_article
-- ----------------------------

-- ----------------------------
-- Table structure for test_article_type
-- ----------------------------
DROP TABLE IF EXISTS `test_article_type`;
CREATE TABLE `test_article_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章类型表',
  `name` varchar(50) NOT NULL COMMENT '文章类型标识，便于索引',
  `title` varchar(100) NOT NULL COMMENT '文章类型标题',
  `shang` varchar(100) NOT NULL COMMENT '上级分类，若没有，为顶级分类',
  `content` text NOT NULL COMMENT '文章类型内容',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `endtime` int(11) NOT NULL COMMENT '编辑时间',
  `sort` int(11) NOT NULL COMMENT '文章类型排序',
  `status` tinyint(4) NOT NULL COMMENT '不同的状态值代表不同的操作',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_article_type
-- ----------------------------

-- ----------------------------
-- Table structure for test_auth_extend
-- ----------------------------
DROP TABLE IF EXISTS `test_auth_extend`;
CREATE TABLE `test_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL COMMENT '权限扩展表，组ID ',
  `extend_id` mediumint(10) unsigned NOT NULL COMMENT '扩展表中数据的id',
  `type` tinyint(1) NOT NULL COMMENT '扩展类型标识 1:栏目分类权限;2:模型权限'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_auth_extend
-- ----------------------------

-- ----------------------------
-- Table structure for test_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `test_auth_group`;
CREATE TABLE `test_auth_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限组表',
  `module` varchar(100) NOT NULL COMMENT '用户组所属的模块',
  `type` varchar(100) NOT NULL COMMENT '用户组的类型',
  `title` varchar(50) NOT NULL COMMENT '用户组的标题',
  `description` varchar(255) NOT NULL COMMENT '对用户组的一些描述',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '用户组的状态，为1正常，为0禁用,-1为删除',
  `rules` text NOT NULL COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_auth_group
-- ----------------------------
INSERT INTO `test_auth_group` VALUES ('1', 'admin', '1', '测试', '执行测试的操作', '1', '1,3,5,6,7,17,18,53,54,57');

-- ----------------------------
-- Table structure for test_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `test_auth_group_access`;
CREATE TABLE `test_auth_group_access` (
  `uid` int(11) unsigned NOT NULL COMMENT '权限组成员，管理员的id',
  `group_id` mediumint(8) unsigned DEFAULT NULL COMMENT '用户组的id',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_auth_group_access
-- ----------------------------
INSERT INTO `test_auth_group_access` VALUES ('2', '1');

-- ----------------------------
-- Table structure for test_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `test_auth_rule`;
CREATE TABLE `test_auth_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限规则表',
  `module` varchar(80) NOT NULL COMMENT '规则所属的模块',
  `type` tinyint(50) NOT NULL DEFAULT '1' COMMENT '权限所属的模块 ,1-url;2-主菜单',
  `name` varchar(255) NOT NULL COMMENT '权限规则标识，一般为URL地址',
  `title` varchar(100) NOT NULL COMMENT '权限规则描述，一般为标题',
  `status` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '不同的状态值代表不同的操作，是否有效(0:无效,1:有效)',
  `condition` varchar(255) NOT NULL COMMENT '规则的附加条件',
  `pid` int(11) unsigned NOT NULL COMMENT '父集的id',
  `addtime` int(11) NOT NULL COMMENT '权限规则的添加时间',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`type`,`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_auth_rule
-- ----------------------------
INSERT INTO `test_auth_rule` VALUES ('1', 'admin', '2', 'Admin/Index/index', '系统', '1', '', '0', '1515996860');
INSERT INTO `test_auth_rule` VALUES ('2', 'admin', '2', 'Admin/User/index', '用户', '1', '', '0', '1515996883');
INSERT INTO `test_auth_rule` VALUES ('3', 'admin', '2', 'Admin/Article/index', '内容', '1', '', '0', '1515996908');
INSERT INTO `test_auth_rule` VALUES ('4', 'admin', '2', 'Admin/Config/index', '设置', '1', '', '0', '1515996935');
INSERT INTO `test_auth_rule` VALUES ('5', 'admin', '2', 'Admin/Tools/index', '工具', '1', '', '0', '1515996959');
INSERT INTO `test_auth_rule` VALUES ('6', 'admin', '1', 'Admin/Index/index', '系统管理首页', '1', '', '1', '1515997090');
INSERT INTO `test_auth_rule` VALUES ('7', 'admin', '1', 'Admin/index/counts', '系统概览', '1', '', '1', '1515997119');
INSERT INTO `test_auth_rule` VALUES ('8', 'admin', '1', 'Admin/User/index', '用户管理首页', '1', '', '2', '1515998562');
INSERT INTO `test_auth_rule` VALUES ('9', 'admin', '1', 'Admin/User/admin', '管理员列表', '1', '', '2', '1515998601');
INSERT INTO `test_auth_rule` VALUES ('10', 'admin', '1', 'Admin/User/adminEdit', '编辑添加(管理员列表)', '1', '', '9', '1515998649');
INSERT INTO `test_auth_rule` VALUES ('11', 'admin', '1', 'Admin/User/adminStatus', '修改状态(管理员列表)', '1', '', '9', '1515998675');
INSERT INTO `test_auth_rule` VALUES ('12', 'admin', '1', 'Admin/User/setpwd', '修改密码(管理员)', '1', '', '9', '1515998701');
INSERT INTO `test_auth_rule` VALUES ('13', 'admin', '1', 'Admin/Config/index', '基本设置首页', '1', '', '4', '1515999886');
INSERT INTO `test_auth_rule` VALUES ('14', 'admin', '1', 'Admin/Config/config', '基本设置', '1', '', '4', '1515999909');
INSERT INTO `test_auth_rule` VALUES ('15', 'admin', '1', 'Admin/Config/configEdit', '编辑(基本设置)', '1', '', '14', '1515999959');
INSERT INTO `test_auth_rule` VALUES ('16', 'admin', '1', 'Admin/Config/image', '上传图片', '1', '', '14', '1515999983');
INSERT INTO `test_auth_rule` VALUES ('17', 'admin', '1', 'Admin/Article/index', '内容管理首页', '1', '', '3', '1516003248');
INSERT INTO `test_auth_rule` VALUES ('18', 'admin', '1', 'Admin/Article/articles', '文章管理', '1', '', '3', '1516003291');
INSERT INTO `test_auth_rule` VALUES ('19', 'admin', '1', 'Admin/Article/articleType', '文章类型', '1', '', '3', '1516003330');
INSERT INTO `test_auth_rule` VALUES ('20', 'admin', '1', 'Admin/Article/adver', '广告管理', '1', '', '3', '1516003371');
INSERT INTO `test_auth_rule` VALUES ('21', 'admin', '1', 'Admin/Article/links', '友链管理', '1', '', '3', '1516003388');
INSERT INTO `test_auth_rule` VALUES ('22', 'admin', '1', 'Admin/Article/articlesEdit', '编辑添加(文章管理)', '1', '', '18', '1516003488');
INSERT INTO `test_auth_rule` VALUES ('23', 'admin', '1', 'Admin/Article/articlesStatus', '修改状态(启用,禁用,删除)', '1', '', '18', '1516003517');
INSERT INTO `test_auth_rule` VALUES ('24', 'admin', '1', 'Admin/Article/articleTypeEdit', '编辑添加(文章类型)', '1', '', '19', '1516003545');
INSERT INTO `test_auth_rule` VALUES ('25', 'admin', '1', 'Admin/Article/articleTypeStatus', '修改状态(启用,禁用,删除)', '1', '', '19', '1516003576');
INSERT INTO `test_auth_rule` VALUES ('26', 'admin', '1', 'Admin/Article/adverEdit', '编辑添加(广告管理)', '1', '', '20', '1516003616');
INSERT INTO `test_auth_rule` VALUES ('27', 'admin', '1', 'Admin/Article/adverStatus', '修改状态(启用,禁用,删除)', '1', '', '20', '1516003667');
INSERT INTO `test_auth_rule` VALUES ('28', 'admin', '1', 'Admin/Article/adverImage', '上传图片(广告管理)', '1', '', '20', '1516003696');
INSERT INTO `test_auth_rule` VALUES ('29', 'admin', '1', 'Admin/Article/linksEdit', '编辑添加(友链管理)', '1', '', '21', '1516003732');
INSERT INTO `test_auth_rule` VALUES ('30', 'admin', '1', 'Admin/Article/linkStatus', '修改状态(启用,禁用,删除)', '1', '', '21', '1516004046');
INSERT INTO `test_auth_rule` VALUES ('31', 'admin', '1', 'Admin/Menu/menu', '菜单管理', '1', '', '4', '1516004195');
INSERT INTO `test_auth_rule` VALUES ('32', 'admin', '1', 'Admin/Menu/menuEdit', '编辑添加(菜单管理)', '1', '', '31', '1516004281');
INSERT INTO `test_auth_rule` VALUES ('33', 'admin', '1', 'Admin/Menu/msubsetEdit', '新增(子集菜单)', '1', '', '31', '1516004306');
INSERT INTO `test_auth_rule` VALUES ('34', 'admin', '1', 'Admin/Menu/menuDete', '删除(父集和子集菜单)', '1', '', '31', '1516004331');
INSERT INTO `test_auth_rule` VALUES ('35', 'admin', '1', 'Admin/User/user', '用户管理', '1', '', '2', '1516004589');
INSERT INTO `test_auth_rule` VALUES ('36', 'admin', '1', 'Admin/Menu/auth', '权限列表', '1', '', '2', '1516004636');
INSERT INTO `test_auth_rule` VALUES ('37', 'admin', '1', 'Admin/User/AdminLog', '登录日志(管理员)', '1', '', '2', '1516004845');
INSERT INTO `test_auth_rule` VALUES ('38', 'admin', '1', 'Admin/User/AdminLogStatus', '日志删除(管理员)', '1', '', '37', '1516004884');
INSERT INTO `test_auth_rule` VALUES ('39', 'admin', '1', 'Admin/User/userEdit', '编辑添加(用户管理)', '1', '', '35', '1516004929');
INSERT INTO `test_auth_rule` VALUES ('40', 'admin', '1', 'Admin/User/userStatus', '修改状态(清除缓存)', '1', '', '35', '1516004983');
INSERT INTO `test_auth_rule` VALUES ('41', 'admin', '1', 'Admin/Menu/AuthEdit', '编辑添加(权限列表)', '1', '', '36', '1516005092');
INSERT INTO `test_auth_rule` VALUES ('42', 'admin', '1', 'Admin/Menu/AuthsEdit', '新增(子集权限)', '1', '', '36', '1516005123');
INSERT INTO `test_auth_rule` VALUES ('43', 'admin', '1', 'Admin/Menu/AuthDelete', '删除(父集和子集权限)', '1', '', '36', '1516005148');
INSERT INTO `test_auth_rule` VALUES ('44', 'admin', '1', 'Admin/User/auth', '权限管理', '1', '', '2', '1516005201');
INSERT INTO `test_auth_rule` VALUES ('45', 'admin', '1', 'Admin/User/authEdit', '编辑添加(权限管理)', '1', '', '44', '1516005230');
INSERT INTO `test_auth_rule` VALUES ('46', 'admin', '1', 'Admin/User/authStatus', '修改状态(启用,禁用,删除)', '1', '', '44', '1516005265');
INSERT INTO `test_auth_rule` VALUES ('47', 'admin', '1', 'Admin/User/authStart', '重新初始化权限', '1', '', '44', '1516005286');
INSERT INTO `test_auth_rule` VALUES ('48', 'admin', '1', 'Admin/User/authAccess', '访问授权', '1', '', '44', '1516005311');
INSERT INTO `test_auth_rule` VALUES ('49', 'admin', '1', 'Admin/User/authUser', '成员授权页面', '1', '', '44', '1516005343');
INSERT INTO `test_auth_rule` VALUES ('50', 'admin', '1', 'Admin/User/authAccessUp', '确认访问授权', '1', '', '48', '1516005373');
INSERT INTO `test_auth_rule` VALUES ('51', 'admin', '1', 'Admin/User/authUserAdd', '添加成员授权', '1', '', '49', '1516005396');
INSERT INTO `test_auth_rule` VALUES ('52', 'admin', '1', 'Admin/User/authUserRemove', '解除成员授权', '1', '', '49', '1516005416');
INSERT INTO `test_auth_rule` VALUES ('53', 'admin', '1', 'Admin/Tools/index', '工具管理首页', '1', '', '5', '1516005515');
INSERT INTO `test_auth_rule` VALUES ('54', 'admin', '1', 'Admin/Tools/clean', '清除缓存', '1', '', '5', '1516005547');
INSERT INTO `test_auth_rule` VALUES ('55', 'admin', '1', 'Admin/Tools/dataExport', '备份数据库', '1', '', '5', '1516005564');
INSERT INTO `test_auth_rule` VALUES ('56', 'admin', '1', 'Admin/Tools/dataImport', '还原数据库', '1', '', '5', '1516005579');
INSERT INTO `test_auth_rule` VALUES ('57', 'admin', '1', 'Admin/Tools/delcache', '清除缓存状态', '1', '', '54', '1516005610');
INSERT INTO `test_auth_rule` VALUES ('58', 'admin', '1', 'Admin/Tools/database', '数据库备份操作', '1', '', '55', '1516005651');
INSERT INTO `test_auth_rule` VALUES ('59', 'admin', '1', 'Admin/Tools/optimize', '优化表', '1', '', '55', '1516005683');
INSERT INTO `test_auth_rule` VALUES ('60', 'admin', '1', 'Admin/Tools/repair', '修护表', '1', '', '55', '1516005709');
INSERT INTO `test_auth_rule` VALUES ('61', 'admin', '1', 'Admin/Tools/excel', '导出表', '1', '', '55', '1516005725');
INSERT INTO `test_auth_rule` VALUES ('62', 'admin', '1', 'Admin/Tools/exportExcel', '导出Excel表的操作', '1', '', '55', '1516005754');
INSERT INTO `test_auth_rule` VALUES ('63', 'admin', '1', 'Admin/Tools/import', '还原数据库的操作', '1', '', '56', '1516005822');
INSERT INTO `test_auth_rule` VALUES ('64', 'admin', '1', 'Admin/Tools/xiazai', '下载', '1', '', '56', '1516005834');
INSERT INTO `test_auth_rule` VALUES ('65', 'admin', '1', 'Admin/Tools/del', '删除', '1', '', '56', '1516005847');

-- ----------------------------
-- Table structure for test_config
-- ----------------------------
DROP TABLE IF EXISTS `test_config`;
CREATE TABLE `test_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '网站配置表',
  `web_name` varchar(200) NOT NULL COMMENT '网站名称',
  `web_title` varchar(255) NOT NULL COMMENT '网站标题',
  `web_logo` varchar(255) NOT NULL COMMENT '网站LOGO',
  `web_keywords` varchar(255) NOT NULL COMMENT '网站关键字',
  `web_description` varchar(255) NOT NULL COMMENT '网站描述',
  `web_icp` varchar(100) NOT NULL COMMENT '网站备案号',
  `web_ban` text NOT NULL COMMENT '网站禁止访问原因',
  `web_close` tinyint(4) NOT NULL COMMENT '网站的状态，不同的状态值代表不同的操作',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_config
-- ----------------------------
INSERT INTO `test_config` VALUES ('1', '测试', '测试网站', '5a5c53832ab98.jpg', '', '', '', '网站进行维护中', '1');

-- ----------------------------
-- Table structure for test_link
-- ----------------------------
DROP TABLE IF EXISTS `test_link`;
CREATE TABLE `test_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '友情链接表',
  `name` varchar(50) NOT NULL COMMENT '友情链接标识(便于索引)',
  `title` varchar(100) NOT NULL COMMENT '友情链接标题',
  `url` varchar(100) NOT NULL COMMENT '友情链接URL',
  `img` varchar(255) NOT NULL COMMENT '友情链接小图标',
  `sort` int(11) NOT NULL COMMENT '友情链接排序',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `endtime` int(11) NOT NULL COMMENT '编辑时间',
  `status` tinyint(4) NOT NULL COMMENT '不同的状态值代表不同的操作',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_link
-- ----------------------------
INSERT INTO `test_link` VALUES ('1', 'baidu', '百度一下', 'https://www.baidu.com/', '', '0', '1516002697', '1516002695', '1');

-- ----------------------------
-- Table structure for test_menu
-- ----------------------------
DROP TABLE IF EXISTS `test_menu`;
CREATE TABLE `test_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单列表,菜单的id，也是父集的id',
  `title` varchar(100) NOT NULL COMMENT '菜单的标题',
  `pid` int(11) NOT NULL COMMENT '上级分类的id',
  `sort` int(11) unsigned NOT NULL COMMENT '菜单的排序',
  `url` varchar(255) NOT NULL COMMENT '菜单的url链接',
  `hide` tinyint(2) NOT NULL COMMENT '是否进行隐藏',
  `tip` varchar(255) NOT NULL COMMENT '提示信息',
  `group` varchar(100) NOT NULL COMMENT '菜单分组',
  `is_dev` varchar(100) NOT NULL DEFAULT '0' COMMENT '是否开发模式可见',
  `ico_name` varchar(50) NOT NULL COMMENT '菜单图标设计',
  `addtime` int(11) NOT NULL COMMENT '菜单图标的设计',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_menu
-- ----------------------------
INSERT INTO `test_menu` VALUES ('1', '系统', '0', '0', 'Index/index', '0', '', '', '0', 'icon-home', '1515991376');
INSERT INTO `test_menu` VALUES ('2', '用户', '0', '2', 'User/index', '0', '', '', '0', 'icon-user', '1515991405');
INSERT INTO `test_menu` VALUES ('3', '内容', '0', '1', 'Admin/Article/index', '0', '', '', '0', 'icon-paste', '1515991400');
INSERT INTO `test_menu` VALUES ('4', '设置', '0', '3', 'Admin/Config/index', '0', '', '', '0', 'icon-cog', '1515991428');
INSERT INTO `test_menu` VALUES ('5', '工具', '0', '4', 'Admin/Tools/index', '0', '', '', '0', 'icon-briefcase', '1515991446');
INSERT INTO `test_menu` VALUES ('6', '系统管理首页', '1', '1', 'Admin/Index/index', '0', '', '系统', '0', 'icon-home', '1515991392');
INSERT INTO `test_menu` VALUES ('7', '用户管理首页', '2', '0', 'User/index', '0', '', '用户', '0', 'icon-home', '1515991413');
INSERT INTO `test_menu` VALUES ('8', '权限管理', '2', '1', 'Admin/User/auth', '0', '', '权限管理', '0', 'icon-home', '1515991420');
INSERT INTO `test_menu` VALUES ('9', '设置管理首页', '4', '1', 'Config/index', '0', '', '设置', '0', '', '1515991434');
INSERT INTO `test_menu` VALUES ('10', '菜单管理', '4', '1', 'Admin/Menu/menu', '0', '', '菜单管理', '0', 'icon-file-text', '1515991439');
INSERT INTO `test_menu` VALUES ('11', '编辑添加(菜单管理)', '10', '0', 'Admin/Menu/menuEdit', '1', '', '菜单管理', '0', '', '1515995972');
INSERT INTO `test_menu` VALUES ('12', '新增(子集菜单)', '10', '1', 'Admin/Menu/msubsetEdit', '1', '', '菜单管理', '0', '', '1515996103');
INSERT INTO `test_menu` VALUES ('13', '删除(父集菜单和子集菜单)', '10', '0', 'Admin/Menu/menuDete', '1', '', '菜单管理', '0', '', '1515996146');
INSERT INTO `test_menu` VALUES ('15', '权限列表', '2', '1', 'Admin/Menu/auth', '0', '', '权限管理', '0', '', '1515996758');
INSERT INTO `test_menu` VALUES ('16', '系统概览', '1', '1', 'Admin/index/counts', '0', '', '系统', '0', 'icon-list', '1515997303');
INSERT INTO `test_menu` VALUES ('17', '编辑添加(权限列表)', '15', '0', 'Admin/Menu/AuthEdit', '1', '', '权限列表', '0', '', '1515997683');
INSERT INTO `test_menu` VALUES ('18', '新增(子集权限)', '15', '0', 'Admin/Menu/AuthsEdit', '1', '', '权限列表', '0', '', '1515997724');
INSERT INTO `test_menu` VALUES ('19', '删除(父集和子集权限)', '15', '0', 'Admin/Menu/AuthDelete', '1', '', '权限列表', '0', '', '1515997762');
INSERT INTO `test_menu` VALUES ('20', '管理员列表', '2', '0', 'Admin/User/admin', '0', '', '管理员', '0', 'icon-user-md', '1515997973');
INSERT INTO `test_menu` VALUES ('21', '编辑添加(管理员列表)', '20', '0', 'Admin/User/adminEdit', '1', '', '管理员列表', '0', '', '1515998081');
INSERT INTO `test_menu` VALUES ('22', '修改状态', '20', '0', 'Admin/User/adminStatus', '0', '', '管理员列表', '0', '', '1515998156');
INSERT INTO `test_menu` VALUES ('23', '修改密码(管理员)', '20', '0', 'Admin/User/setpwd', '1', '', '管理员列表', '0', '', '1515998217');
INSERT INTO `test_menu` VALUES ('24', '登录日志', '2', '2', 'Admin/User/AdminLog', '0', '', '管理员', '0', 'icon-map-marker', '1515998327');
INSERT INTO `test_menu` VALUES ('25', '删除(管理员登录日志删除)', '24', '0', 'Admin/User/AdminLogStatus', '1', '', '登录日志', '0', '', '1515998444');
INSERT INTO `test_menu` VALUES ('26', '编辑添加(权限管理)', '8', '0', 'Admin/User/authEdit', '1', '', '权限管理', '0', '', '1515998956');
INSERT INTO `test_menu` VALUES ('27', '修改状态(启用,禁用,删除)', '8', '0', 'Admin/User/authStatus', '1', '', '权限管理', '0', '', '1515999027');
INSERT INTO `test_menu` VALUES ('28', '重新初始化权限', '8', '0', 'Admin/User/authStart', '1', '', '权限管理', '0', '', '1515999066');
INSERT INTO `test_menu` VALUES ('29', '访问授权', '8', '0', 'Admin/User/authAccess', '1', '', '权限管理', '0', '', '1515999140');
INSERT INTO `test_menu` VALUES ('30', '确认访问授权', '29', '0', 'Admin/User/authAccessUp', '1', '', '权限管理', '0', '', '1515999188');
INSERT INTO `test_menu` VALUES ('31', '成员授权页面', '8', '0', 'Admin/User/authUser', '1', '', '权限管理', '0', '', '1515999233');
INSERT INTO `test_menu` VALUES ('32', '添加成员授权', '31', '0', 'Admin/User/authUserAdd', '1', '', '成员授权页面', '0', '', '1515999325');
INSERT INTO `test_menu` VALUES ('33', '解除成员授权', '31', '0', 'Admin/User/authUserRemove', '1', '', '成员授权页面', '0', '', '1515999368');
INSERT INTO `test_menu` VALUES ('34', '用户管理', '2', '2', 'Admin/User/user', '0', '', '用户', '0', 'icon-user', '1515999455');
INSERT INTO `test_menu` VALUES ('35', '编辑添加(用户管理)', '34', '0', 'Admin/User/userEdit', '1', '', '用户管理', '0', '', '1515999542');
INSERT INTO `test_menu` VALUES ('36', '修改状态(启用,禁用，删除)', '34', '0', 'Admin/User/userStatus', '1', '', '用户管理', '0', '', '1515999576');
INSERT INTO `test_menu` VALUES ('37', '基本设置', '4', '2', 'Admin/Config/config', '0', '', '设置', '0', 'icon-cog', '1515999686');
INSERT INTO `test_menu` VALUES ('38', '编辑(基本设置)', '37', '0', 'Admin/Config/configEdit', '1', '', '基本设置', '0', '', '1515999747');
INSERT INTO `test_menu` VALUES ('39', '上传图片', '37', '0', 'Admin/Config/image', '1', '', '基本设置', '0', '', '1515999803');
INSERT INTO `test_menu` VALUES ('40', '工具管理首页', '5', '0', 'Tools/index', '0', '', '工具', '0', 'icon-briefcase', '1516000344');
INSERT INTO `test_menu` VALUES ('41', '清除缓存', '5', '0', 'Admin/Tools/clean', '0', '', '工具', '0', 'icon-trash', '1516000413');
INSERT INTO `test_menu` VALUES ('42', '清除缓存状态', '41', '0', 'Admin/Tools/delcache', '1', '', '清除缓存', '0', '', '1516000544');
INSERT INTO `test_menu` VALUES ('43', '备份数据库', '5', '0', 'Admin/Tools/dataExport', '0', '', '工具', '0', 'icon-copy', '1516000685');
INSERT INTO `test_menu` VALUES ('44', '还原数据库', '5', '0', 'Admin/Tools/dataImport', '0', '', '工具', '0', 'icon-undo', '1516000736');
INSERT INTO `test_menu` VALUES ('45', '数据库备份操作', '43', '0', 'Admin/Tools/database', '1', '', '备份数据库', '0', '', '1516001072');
INSERT INTO `test_menu` VALUES ('46', '优化表', '43', '0', 'Admin/Tools/optimize', '1', '', '备份数据库', '0', '', '1516001107');
INSERT INTO `test_menu` VALUES ('47', '修复表', '43', '0', 'Admin/Tools/repair', '1', '', '备份数据库', '0', '', '1516001137');
INSERT INTO `test_menu` VALUES ('48', '导出表', '43', '0', 'Admin/Tools/excel', '1', '', '备份数据库', '0', '', '1516001207');
INSERT INTO `test_menu` VALUES ('49', '导出Excel表的操作', '43', '0', 'Admin/Tools/exportExcel', '1', '', '备份数据库', '0', '', '1516001238');
INSERT INTO `test_menu` VALUES ('50', '还原数据库的操作', '44', '0', 'Admin/Tools/import', '1', '', '还原数据库', '0', '', '1516001386');
INSERT INTO `test_menu` VALUES ('51', '下载', '44', '0', 'Admin/Tools/xiazai', '1', '', '还原数据库', '0', '', '1516001417');
INSERT INTO `test_menu` VALUES ('52', '删除(还原数据库)', '44', '0', 'Admin/Tools/del', '1', '', '还原数据库', '0', '', '1516001446');
INSERT INTO `test_menu` VALUES ('53', '内容管理首页', '3', '0', 'Article/index', '0', '', '内容', '0', 'icon-th-large', '1516001827');
INSERT INTO `test_menu` VALUES ('54', '广告管理', '3', '3', 'Admin/Article/adver', '0', '', '内容', '0', 'icon-picture', '1516002068');
INSERT INTO `test_menu` VALUES ('55', '友链管理', '3', '4', 'Admin/Article/links', '0', '', '内容', '0', 'icon-globe', '1516002140');
INSERT INTO `test_menu` VALUES ('56', '文章类型', '3', '2', 'Admin/Article/articleType', '0', '', '内容', '0', 'icon-list-alt', '1516002219');
INSERT INTO `test_menu` VALUES ('57', '文章管理', '3', '1', 'Admin/Article/articles', '0', '', '内容', '0', 'icon-file', '1516002273');
INSERT INTO `test_menu` VALUES ('58', '编辑添加(广告管理)', '54', '0', 'Admin/Article/adverEdit', '1', '', '广告管理', '0', '', '1516002416');
INSERT INTO `test_menu` VALUES ('59', '修改状态(启用,禁用,删除)', '54', '0', 'Admin/Article/adverStatus', '1', '', '广告管理', '0', '', '1516002469');
INSERT INTO `test_menu` VALUES ('60', '上传图片(广告管理)', '54', '0', 'Admin/Article/adverImage', '1', '', '广告管理', '0', '', '1516002543');
INSERT INTO `test_menu` VALUES ('61', '编辑添加(友链管理)', '55', '0', 'Admin/Article/linksEdit', '1', '', '友链管理', '0', '', '1516002596');
INSERT INTO `test_menu` VALUES ('62', '修改状态(启用,禁用,删除)', '55', '0', 'Admin/Article/linkStatus', '1', '', '友链管理', '0', '', '1516002641');
INSERT INTO `test_menu` VALUES ('63', '编辑添加(文章类型)', '56', '0', 'Admin/Article/articleTypeEdit', '1', '', '文章类型', '0', '', '1516002799');
INSERT INTO `test_menu` VALUES ('64', '修改状态(启用,禁用,删除)', '56', '0', 'Admin/Article/articleTypeStatus', '1', '', '文章类型', '0', '', '1516002851');
INSERT INTO `test_menu` VALUES ('65', '编辑添加(文章管理)', '57', '0', 'Admin/Article/articlesEdit', '1', '', '文章管理', '0', '', '1516002975');
INSERT INTO `test_menu` VALUES ('66', '修改状态(启用,禁用,删除)', '57', '0', 'Admin/Article/articlesStatus', '1', '', '文章管理', '0', '', '1516003020');

-- ----------------------------
-- Table structure for test_user
-- ----------------------------
DROP TABLE IF EXISTS `test_user`;
CREATE TABLE `test_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户表',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `email` varchar(100) NOT NULL COMMENT '邮箱地址',
  `password` varchar(255) NOT NULL COMMENT '用户登录密码',
  `mobile` varchar(255) NOT NULL COMMENT '用户手机号',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `endtime` int(11) NOT NULL COMMENT '编辑时间',
  `status` tinyint(11) NOT NULL COMMENT '不同的状态是代表不同的操作',
  PRIMARY KEY (`id`),
  KEY `username` (`username`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test_user
-- ----------------------------
INSERT INTO `test_user` VALUES ('1', 'chenix', '', '', '', '0', '0', '1');
