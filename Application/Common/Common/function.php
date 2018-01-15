<?php
//执行对验证码的判断
function check_verify($code, $id = 1)
{
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}
//list_to_tree 实现无限级分类列出所有节点 
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{
	$tree = array();

	if (is_array($list)) {
		$refer = array();

		foreach ($list as $key => $data) {
			$refer[$data[$pk]] = &$list[$key];
		}

		foreach ($list as $key => $data) {
			$parentId = $data[$pid];

			if ($root == $parentId) {
				$tree[] = &$list[$key];
			}
			else if (isset($refer[$parentId])) {
				$parent = &$refer[$parentId];
				$parent[$child][] = &$list[$key];
			}
		}
	}

	return $tree;
}
//执行整形转换成字符串
function int_to_string(&$data, $map = array(
		'status' => array(1 => '正常', -1 => '删除', 0 => '禁用', 2 => '未审核', 3 => '草稿')
		))
{
	if (($data === false) || ($data === NULL)) {
		return $data;
	}

	$data = (array) $data;

	foreach ($data as $key => $row) {
		foreach ($map as $col => $pair) {
			if (isset($row[$col]) && isset($pair[$row[$col]])) {
				$data[$key][$col . '_text'] = $pair[$row[$col]];
			}
		}
	}

	return $data;
}
//执行核对;
function check($data, $rule = NULL, $ext = NULL)
{
	$data = trim(str_replace(PHP_EOL, '', $data));

	if (empty($data)) {
		return false;
	}
	$validate['username'] = '/^(?![a-zA-Z]+$)(?!\d+$)[a-zA-z]+.{5,15}$/';
	$validate['mobile'] = '/^(((1[0-9][0-9]{1})|159|153)+\\d{8})$/';
	$validate['password'] = '/^(?![0-9]+$)(?![a-zA-Z]+$)(?![_\\@\\#\\$\\%\\^\\&\\*\\(\\)\\!\\,\\.\\?\\-\\+\\|\\=]+$)[a-zA-Z0-9_\\@\\#\\$\\%\\^\\&\\*\\(\\)\\!\\,\\.\\?\\-\\+\\|\\=]{6,16}$/';
	$validate['mobile'] = '/^(((1[0-9][0-9]{1})|159|153)+\\d{8})$/';
	$validate['email'] = '/^\\w+([-+.]\\w+)*@\\w+([-.]\\w+)*\\.\\w+([-.]\\w+)*$/';
	if (isset($validate[strtolower($rule)])) {
		$rule = $validate[strtolower($rule)];
		return preg_match($rule, $data);
	}
	$Ap = '\\x{4e00}-\\x{9fff}' . '0-9a-zA-Z\\@\\#\\$\\%\\^\\&\\*\\(\\)\\!\\,\\.\\?\\-\\+\\|\\=';
	$Dp = '0-9';
	$Wp = 'a-zA-Z';
	$pattern = '/^[';
	$OArr = str_split(strtolower($rule));
	in_array('a', $OArr) && ($pattern .= $Ap);
	in_array('d', $OArr) && ($pattern .= $Dp);
	in_array('w', $OArr) && ($pattern .= $Wp);
	isset($ext) && ($pattern .= $ext);
	$pattern .= ']+$/u';
	return preg_match($pattern, $data);
}
//执行判断是否是管理员;
function is_administrator($uid = NULL)
{
	$uid = (is_null($uid) ? is_login() : $uid);
	return $uid && (intval($uid) === C('USER_ADMINISTRATOR'));
}
//执行对时间格式的判断；
function time_format($time = NULL, $format = 'Y-m-d H:i')
{
	$time = ($time === NULL ? NOW_TIME : intval($time));
	return date($format, $time);
}
//执行删除目录的操作
function rmdirr($dirname)
{
	if (!file_exists($dirname)) {
		return false;
	}

	if (is_file($dirname) || is_link($dirname)) {
		return unlink($dirname);
	}

	$dir = dir($dirname);

	if ($dir) {
		while (false !== ($entry = $dir->read())) {
			if (($entry == '.') || ($entry == '..')) {
				continue;
			}

			rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
		}
	}

	$dir->close();
	return rmdir($dirname);
}
//执行判断添加时间的判断;
function addtime($time = NULL,$type = NULL)
{
	if(empty($time)){
		return '---';
	}
	if(($time < 2545545) && (1893430861 < $time)){
		return '---';
	}
	if(empty($type)){
		$type = 'Y-m-d H:i:s';
	}
	return date($type,$time);
}
//执行判断数据大小
function format_bytes($size, $delimiter = '')
{
	$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');

	for ($i = 0; $i < 5; $i++) {
		$size /= 1024;
	}

	return round($size, 2) . $delimiter . $units[$i];
}
//执行下载文件
function DownloadFile($fileName)
{
	ob_end_clean();
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Length: ' . filesize($fileName));
	header('Content-Disposition: attachment; filename=' . basename($fileName));
	readfile($fileName);
}
?>