<?php
namespace Home\Controller;
use Think\Controller;
class HomeController extends Controller {
	protected function _initialize()
	{
		$config = (APP_DEBUG ? NULL : S('home_config'));
		if(!$config){
			$config = M('Config')->where(array('id' => 1))->find();
			S('home_config',$config);
		}
		if(!session('web_close')){
			if(!$config['web_close']){
				$this->assign('content',$config['web_ban']);
				$this->assign('title',$config['web_titleT']);
				exit($this->display('Public:Err'));
			}
		}
		C($config);
	}
}