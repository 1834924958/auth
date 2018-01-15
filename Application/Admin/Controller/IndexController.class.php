<?php
namespace Admin\Controller;

class IndexController extends AdminController {
    public function index()
	{
		$this->display();
    }
	//执行系统概览;
	public  function counts()
	{
        $arr = array();
        $arr['mysql'] = M()->query("select version() as v");
        $this->assign('arr',$arr);
        $phpModel = php_sapi_name();
        $this->assign('phpModel',$phpModel);
        //上传文件限制
        $fileLimit = ini_get('upload_max_filesize');
        $this->assign('fileLimit',$fileLimit);
        //执行时间限制；
        $etimeLimit = ini_get('max_execution_time');
        $this->assign('etimeLimit',$etimeLimit);
        //剩余空间
        $Rspace  = round((disk_free_space(".")/(1024*1024)),2).'&nbsp;M';
        $this->assign('Rspace',$Rspace);
        //注册为全局变量
        $Variable = get_cfg_var("register_globals")=="1" ? "ON" : "OFF";
        $this->assign('Variable',$Variable);
        //判断解析用户提示的数据;
        $jiexi = (1===get_magic_quotes_gpc())?'YES':'NO';
        $this->assign('jiexi',$jiexi);
        //反斜线转义
        $zhuanyi = (1===get_magic_quotes_runtime())?'YES':'NO';
        $this->assign('zhuanyi',$zhuanyi);
		$this->display();
	}
}