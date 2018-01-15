<?php
namespace Admin\Controller;
class LoginController extends \Think\Controller {
	public function index($username = NULL, $password = NULL, $verify = NULL)
	{
		if (IS_POST) {
			if (!check_verify($verify)){
				$this->error('验证码输入错误！');
			}
			$admin = M('Admin')->where(array('username' => $username))->find();
			if ($admin['password'] != md5($password)){
				$this->error('用户名或密码错误！');
			}else if($admin['status'] == '0'){
				$this->error('账户已冻结!');
			}else{
                $adminid  =  $admin['id'];
                $ip  = get_client_ip();
                $logintime  = time();
                $where = array();
                $where['uid'] = $adminid;
                $where['loginip'] = $ip;
                $where['logintime'] = $logintime;
                M('AdminLog')->add($where);
				session('admin_id', $admin['id']);
				session('admin_username', $admin['username']);
				session('admin_password', $admin['password']);
				$this->success('登陆成功!', U('Index/index'));
			}
		}else{
			if (session('admin_id')){
				$this->redirect('Admin/Index/index');
			}
			$this->display();
		}
	}
	//执行退出后台的操作；
	public function loginout()
	{
		session(NULL);
		$this->redirect('Login/index');
	}
	//执行锁屏的操作;
	public function lockScreen()
	{
		if(!IS_POST){
			$this->display();
		}else{
			$pass = trim(I('post.pass'));
			if($pass){
				session('lockScreen',$pass);
				session('lockScreenTime',3);
				$this->success('锁屏成功，正在跳转中！','/Admin/login');
			}else{
				$this->error('请输入一个锁屏密码');
			}
		}
	}
	//执行解锁的操作;
	public function unlock()
	{
		if(!session('admin_id')){
			session(null);
			$this->error('登录已经失效,请重新进行登录....','/Admin/login');
		}
		if(session('lockScreenTime') < 0){
			session(null);
			$this->error('登录密码错误过多，请重新登录....','/Admin/login');
		}
		$pass = trim(I('post.pass'));
		if($pass == session('lockScreen')){
			session('lockScreen',null);
			$this->success('解锁成功','/Admin/index');
		}
		$admin = M('Admin')->where(array('id' => session('admin_id')))->find();
		if($admin['password'] == md5($password)){
			session('lockScreen',null);
			$this->success('解锁成功','/Admin/index');
		}
		session('lockScreenTime',session('lockScreenTime') -1);
		$this->error('用户名或者密码错误');
	}
}