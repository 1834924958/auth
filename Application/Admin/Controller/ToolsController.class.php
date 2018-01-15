<?php
namespace Admin\Controller;

class ToolsController extends AdminController {
    public function index()
	{
		$this->display();
    }
	//清理缓存的页面;
	public  function clean()
	{
		$size = $this->getDirSize('./Runtime/');
		$this->assign('cacheSize', round($size / pow(1024, $i = floor(log($size, 1024))), 2));
		$this->display();
	}
	//获取目录的大小;
	protected function getDirSize($dir)
	{
		$sizeRusult = '';
		$handle  = opendir($dir);
		while(false !== ($FolderOrFile = readdir($handle))){
			if(($FolderOrFile != '.') && ($FolderOrFile != '..')){
				if(is_dir($dir . '/' . $FolderOrFile)){
					$sizeRusult += $this->getDirSize($dir . '/' . $FolderOrFile);
				}else{
					$sizeRusult += filesize($dir . '/' . $FolderOrFile);
				}
			}
		}
		closedir($handle);
		return $sizeRusult;
	}
	//执行清除缓存;
	public function delcache()
	{
		$dirs = array('./Runtime/');
		@mkdir('Runtime', 511, true);

		foreach ($dirs as $value) {
			$this->rmdirr($value);
		}

		@mkdir('Runtime', 511, true);
		$this->success('系统缓存清除成功！');
	}
	//执行删除目录的操作;
	protected function rmdirr($dirname)
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

				$this->rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
			}
		}
		$dir->close();
		return rmdir($dirname);
	}
	//执行备份数据库显示的页面
	public function dataExport()
	{
		redirect('/Admin/Tools/database?type=export');
	}
	//执行导入数据库的操作
	public function dataImport()
	{
		redirect('/Admin/Tools/database?type=import');
	}
	//查询数据表的信息;
	public function database($type = NULL)
	{
		switch ($type) {
		case 'import':
			$path = realpath(DATABASE_PATH);
			$flag = \FilesystemIterator::KEY_AS_FILENAME;
			$glob = new \FilesystemIterator($path, $flag);
			$list = array();

			foreach ($glob as $name => $file) {
				if (preg_match('/^\\d{8,8}-\\d{6,6}-\\d+\\.sql(?:\\.gz)?$/', $name)) {
					$name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');
					$date = $name[0] . '-' . $name[1] . '-' . $name[2];
					$time = $name[3] . ':' . $name[4] . ':' . $name[5];
					$part = $name[6];

					if (isset($list[$date . ' ' . $time])) {
						$info = $list[$date . ' ' . $time];
						$info['part'] = max($info['part'], $part);
						$info['size'] = $info['size'] + $file->getSize();
					}
					else {
						$info['part'] = $part;
						$info['size'] = $file->getSize();
					}

					$extension = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
					$info['compress'] = $extension === 'SQL' ? '-' : $extension;
					$info['time'] = strtotime($date . ' ' . $time);
					$list[$date . ' ' . $time] = $info;
				}
			}

			$title = L('_DATA_REDUCTION_');
			break;

		case 'export':
			$Db = \Think\Db::getInstance();
			$list = $Db->query('SHOW TABLE STATUS');
			$list = array_map('array_change_key_case', $list);
			$title = '数据备份';
			break;

		default:
			$this->error('参数错误！');
		}

		$this->assign('meta_title', $title);
		$this->assign('list', $list);
		$this->display($type);
	}
	//执行数据表的优化；
	public function optimize($tables = NULL)
	{
		if ($tables) {
			$Db = \Think\Db::getInstance();

			if (is_array($tables)) {
				$tables = implode('`,`', $tables);
				$list = $Db->query('OPTIMIZE TABLE `' . $tables . '`');

				if ($list) {
					$this->success('数据表优化完成！');
				}
				else {
					$this->error('数据表优化出错请重试！');
				}
			}
			else {
				$list = $Db->query('OPTIMIZE TABLE `' . $tables . '`');

				if ($list) {
					$this->success('数据表\'' . $tables . '\'优化完成！');
				}
				else {
					$this->error('数据表\'' . $tables . '\'优化出错请重试！');
				}
			}
		}
		else {
			$this->error('请指定要优化的表！');
		}
	}
	//执行数据表的修复;
	public function repair($tables = NULL)
	{
		if ($tables) {
			$Db = \Think\Db::getInstance();

			if (is_array($tables)) {
				$tables = implode('`,`', $tables);
				$list = $Db->query('REPAIR TABLE `' . $tables . '`');

				if ($list) {
					$this->success('数据表修复完成！');
				}
				else {
					$this->error('数据表修复出错请重试！');
				}
			}
			else {
				$list = $Db->query('REPAIR TABLE `' . $tables . '`');

				if ($list) {
					$this->success('数据表\'' . $tables . '\'修复完成！');
				}
				else {
					$this->error('数据表\'' . $tables . '\'修复出错请重试！');
				}
			}
		}
		else {
			$this->error('请指定要修复的表！');
		}
	}
	//执行数据表的导出操作;
	public function excel($tables = NULL)
	{
		if ($tables) {
			$mo = M();
			$mo->execute('set autocommit=0');
			$mo->execute('lock tables ' . $tables . ' write');
			$rs = $mo->table($tables)->select();
			$zd = $mo->table($tables)->getDbFields();

			if ($rs) {
				$mo->execute('commit');
				$mo->execute('unlock tables');
			}
			else {
				$mo->execute('rollback');
			}

			$xlsName = $tables;
			$xls = array();

			foreach ($zd as $k => $v) {
				$xls[$k][0] = $v;
				$xls[$k][1] = $v;
			}

			$this->exportExcel($xlsName, $xls, $rs);
		}
		else {
			$this->error('请指定要导出的表！');
		}
	}
	//执行导出excel表格
	public function exportExcel($expTitle, $expCellName, $expTableData)
	{
		import('Org.Util.PHPExcel');
		import('Org.Util.PHPExcel.Writer.Excel5');
		import('Org.Util.PHPExcel.IOFactory.php');
		$xlsTitle = iconv('utf-8', 'gb2312', $expTitle);
		$fileName = $_SESSION['loginAccount'] . date('_YmdHis');
		$cellNum = count($expCellName);
		$dataNum = count($expTableData);
		$objPHPExcel = new \PHPExcel();
		$cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
		$objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle . '  Export time:' . date('Y-m-d H:i:s'));

		for ($i = 0; $i < $cellNum; $i++) {
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][1]);
		}

		for ($i = 0; $i < $dataNum; $i++) {
			for ($j = 0; $j < $cellNum; $j++) {
				$objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + 3), $expTableData[$i][$expCellName[$j][0]]);
			}
		}

		ob_end_clean();
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
		header('Content-Disposition:attachment;filename=' . $fileName . '.xls');
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit();
	}
	//执行备份数据表
	public function export($tables = NULL, $id = NULL, $start = NULL)
	{

		if (C('web_close')) {
			$this->error('请先关闭网站再备份数据库！');
		}

		if (IS_POST && !empty($tables) && is_array($tables)) {
			$config = array('path' => realpath(DATABASE_PATH) . DIRECTORY_SEPARATOR, 'part' => 20971520, 'compress' => 1, 'level' => 9);
			$lock = $config['path'] . 'backup.lock';

			if (is_file($lock)) {
				$this->error('检测到有一个备份任务正在执行，请稍后再试！');
			}
			else {
				file_put_contents($lock, NOW_TIME);
			}

			is_writeable($config['path']) || $this->error('备份目录不存在或不可写，请检查后重试！');
			session('backup_config', $config);
			$file = array('name' => date('Ymd-His', NOW_TIME), 'part' => 1);
			session('backup_file', $file);
			session('backup_tables', $tables);
			$Database = new \OT\Database($file, $config);

			if (false !== $Database->create()) {
				$tab = array('id' => 0, 'start' => 0);
				$this->success('初始化成功！', '', array('tables' => $tables, 'tab' => $tab));
			}
			else {
				$this->error('初始化失败，备份文件创建失败！');
			}
		}
		else {
			if (IS_GET && is_numeric($id) && is_numeric($start)) {
				$tables = session('backup_tables');
				$Database = new \OT\Database(session('backup_file'), session('backup_config'));
				$start = $Database->backup($tables[$id], $start);

				if (false === $start) {
					$this->error('备份出错！');
				}
				else if (0 === $start) {
					if (isset($tables[++$id])) {
						$tab = array('id' => $id, 'start' => 0);
						$this->success('备份完成！', '', array('tab' => $tab));
					}
					else {
						unlink(session('backup_config.path') . 'backup.lock');
						session('backup_tables', null);
						session('backup_file', null);
						session('backup_config', null);
						$this->success('备份完成！');
					}
				}
				else {
					$tab = array('id' => $id, 'start' => $start[0]);
					$rate = floor(100 * ($start[0] / $start[1]));
					$this->success('正在备份...(' . $rate . '%)', '', array('tab' => $tab));
				}
			}
			else {
				$this->error('参数错误！');
			}
		}
	}
	//执行下载的操作
	public function xiazai()
	{
		if (!check($_GET['file'], 'dw', '-.')) {
			$this->error('失败！');
		}

		DownloadFile(DATABASE_PATH . $_GET['file']);
		exit();
	}
	//执行删除的操作
	public function del($time = 0)
	{
		if ($time) {
			$name = date('Ymd-His', $time) . '-*.sql*';
			$path = realpath(DATABASE_PATH) . DIRECTORY_SEPARATOR . $name;
			array_map('unlink', glob($path));

			if (count(glob($path))) {
				$this->success('备份文件删除失败，请检查权限！');
			}
			else {
				$this->success('备份文件删除成功！');
			}
		}
		else {
			$this->error('参数错误！');
		}
	}
	//执行数据还原的操作
	public function import($time = 0, $part = NULL, $start = NULL)
	{
		if (C('web_close')) {
			$this->error('请先关闭网站再还原数据库！');
		}

		if (is_numeric($time) && is_null($part) && is_null($start)) {
			$name = date('Ymd-His', $time) . '-*.sql*';
			$path = realpath(DATABASE_PATH) . DIRECTORY_SEPARATOR . $name;
			$files = glob($path);
			$list = array();

			foreach ($files as $name) {
				$basename = basename($name);
				$match = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
				$gz = preg_match('/^\\d{8,8}-\\d{6,6}-\\d+\\.sql.gz$/', $basename);
				$list[$match[6]] = array($match[6], $name, $gz);
			}

			ksort($list);
			$last = end($list);

			if (count($list) === $last[0]) {
				session('backup_list', $list);
				$this->success('初始化完成！', '', array('part' => 1, 'start' => 0));
			}
			else {
				$this->error('备份文件可能已经损坏，请检查！');
			}
		}
		else {
			if (is_numeric($part) && is_numeric($start)) {
				$list = session('backup_list');
				$db = new \OT\Database($list[$part], array('path' => realpath(DATABASE_PATH) . DIRECTORY_SEPARATOR, 'compress' => 1, 'level' => 9));
				$start = $db->import($start);
				if (false === $start) {
					$this->error('还原数据出错！');
				}
				else if (0 === $start) {
					if (isset($list[++$part])) {
						$data = array('part' => $part, 'start' => 0);
						$this->success('正在还原...#' . $part, '', $data);
					}
					else {
						session('backup_list', null);
						$this->success('还原完成！');
					}
				}
				else {
					$data = array('part' => $part, 'start' => $start[0]);

					if ($start[1]) {
						$rate = floor(100 * ($start[0] / $start[1]));
						$this->success('正在还原...#' . $part . ' (' . $rate . '%)', '', $data);
					}
					else {
						$data['gz'] = 1;
						$this->success('正在还原...#' . $part, '', $data);
					}
				}
			}
			else {
				$this->error('参数错误！');
			}
		}
	}
	//执行服务器队列的检查的操作
	public  function  queue()
	{
		$file_path = DATABASE_PATH . '/check_queue.json';
		$time = time();
		$timeArr = array();
		if(file_exists($file_path)){
			$timeArr = file_get_contents($file_path);
			$timeArr = json_decode($timeArr,true);
		}
		$str = '';
		foreach($timeArr as $key => $val){
			if($key == 0){
				$val = '上一次执行:' .addtime($val);
			}
			if($key == 1){
				$val = '上二次执行:' .addtime($val);
			}
			if($key == 2){
				$val = '上三次执行:' .addtime($val);
			}
			$str  .= $val . ' ';
		}
		$status = '';
		$count = count($timeArr);
		if( 3 <= $count){
			$_t1 = $timeArr[2] - $timeArr[1];
			$_t2 = $timeArr[1] - $timeArr[0];
			if(60 < abs($timeArr[0] - time())){
				$status = '<span class="btn btn-waring">队列停止运行</span>';
			}
			if((50 < abs($_t1)) && (50 < abs($_t2))){
				$status = '<span class="btn">队列运行正常</span>';
			}else{
				$status = '<span class="btn btn-waring">队列时间异常，请稍后再试</span>';
			}
		}else{
			$msg = '';
			if($count == 0){
				$msg = '队列还未开始运行，请1分钟后刷新';
			}
			if($count == 1){
				$msg = '队列运行一次请等待2分钟检查';
			}
			if($count == 2){
				$msg = '队列运行两次请再等待1分钟检查';
			}
			$status = '<span class="btn btn-waring">' . $msg . '</span>';
		}
		$this->assign('status',$status);
		$this->assign('str',$str);
		$this->display();
		return NULL;
	}

}