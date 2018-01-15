<?php
namespace Admin\Controller;
class VerifyController extends \Think\Controller 
{
	public function code()
	{
		$config['useNoise'] = false;
		$config['length'] = 4;
		$config['codeSet'] = '0123456789';
		$verify = new \Think\Verify($config);
		$verify->entry(1);
	}
}