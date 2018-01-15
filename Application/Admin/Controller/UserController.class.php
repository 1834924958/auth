<?php
namespace Admin\Controller;

class UserController extends AdminController 
{
    public function index()
	{
		$this->display();
    }
	
	//执行管理员的操作
	public function admin($name = NULL,$field = NULL,$status = NULL)
	{
		$where = array();
		if($field && $name){
			if($field == 'username'){
				$where['id'] = M('Admin')->where(array('username' => $name))->getField('id');
			}else{
				$where[$field] = $name;
			}
		}
		if($status){
			$where['status'] = $status -1;
		}
		$count = M('Admin')->where($where)->count();
		$Page = new \Think\Page($count, 4, $parameter);
		$show = $Page->show();
		$list = M('Admin')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
		$this->display();
	}
	//执行管理员编辑的操作;
	public function adminEdit()
	{
		if(empty($_POST)){
			if(empty($_GET['id'])){
				$this->data = null;
			}else{
				$this->data = M('Admin')->where(array('id' => trim($_GET['id'])))->find();
			}
			$this->display();
		}else{
			$input = I('post.');
			if(!check($input['username'],'username')){
				$this->error('用户名格式错误！');
			}
			if($input['nickname'] && !check($input['nickname'],'A')){
				$this->error('昵称格式错误！');
			}
			if($input['password'] && !check($input['password'],'password')){
				$this->error('登录密码格式错误');
			}
			if($input['mobile'] && !check($input['mobile'],'mobile')){
				$this->error('手机号码格式错误！');
			}
			if($input['email'] && !check($input['email'],'email')){
				$this->error('邮箱格式错误！');
			}
			if($input['password']){
				$input['password'] =  md5($input['password']);
			}else{
				unset($input['password']);
			}
			if($_POST['id']){
				$rs = M('Admin')->save($input);
			}else{
				$_POST['addtime'] = time();
				$rs = M('Admin')->add($input);
			}
			if($rs){
				$this->success('编辑成功！');
			}else{
				$this->error('编辑失败！');
			}
		}
		
	}
	//执行管理员状态值的一些操作；
	public  function adminStatus($id = NULL,$type = NULL,$moble = 'Admin')
	{
		if(empty($id)){
			$this->error('参数错误！');
		}
		if(empty($type)){
			$this->error('类型错误！');
		}
		if(strpos(',',$id)){
			$id = implode(',',$id);
		}
		$where['id'] = array('in',$id);
		switch(strtolower($type)){
			case 'forbid':
				$data = array('status' => 0);
				break;
			case 'resume':
				$data = array('status' => 1);
				break;
			case 'del':
				if(M($moble)->where($where)->delete()){
					$this->success('操作成功！');
				}else{
					$this->error('操作失败！');
				}
				break;
			default:
				$this->error('操作失败！');
		}
		if(M($moble)->where($where)->save($data)){
			$this->success('操作成功！');
		}else{
			$this->error('操作失败！');
		}
	}
	//管理员密码的修改;
	public  function setpwd()
	{
		if(IS_POST){
			$oldpassword = $_POST['oldpassword'];
			$newpassword = $_POST['newpassword'];
			$repassword = $_POST['repassword'];
			if(!check($oldpassword,'password')){
				$this->error('旧密码的格式错误！');
			}
			if(md5($oldpassword) != session('admin_password')){
				$this->error('旧密码错误！');
			}
			if(!check($newpassword,'password')){
				$this->error('新密码格式错误！');
			}
			if($newpassword != $repassword){
				$this->error('确认密码错误！');
			}
			if(M('Admin')->where(array('id' => session('admin_id')))->save(array('password' => md5($newpassword)))){
				$this->success('登录密码修改成功！',U('Login/loginout'));
			}else{
				$this->error('登录密码修改失败！');
			}
		}
		$this->display();
	}
	//权限管理
	public function auth()
	{
		$list = $this->lists('AuthGroup', array('module' => 'admin'), 'id asc');
        $list = int_to_string($list);
        $this->assign('_list', $list);
        $this->assign('_use_tip', true);
        $this->meta_title = '权限管理';
		$this->display();
	}
	//权限管理编辑
	public function authEdit()
    {
        if (empty($_POST)) {
            if (empty($_GET['id'])) {
                $this->data = null;
            } else {
                $this->data = M('AuthGroup')->where(array('module' => 'admin', 'type' => \Common\Model\AuthGroupModel::TYPE_ADMIN))->find((int)$_GET['id']);
            }

            $this->display();
        } else {
 

            if (isset($_POST['rules'])) {
                sort($_POST['rules']);
                $_POST['rules'] = implode(',', array_unique($_POST['rules']));
            }

            $_POST['module'] = 'admin';
            $_POST['type'] = \Common\Model\AuthGroupModel::TYPE_ADMIN;
            $AuthGroup = D('AuthGroup');
            $data = $AuthGroup->create();

            if ($data) {
                if (empty($data['id'])) {
                    $r = $AuthGroup->add();
                } else {
                    $r = $AuthGroup->save();
                }

                if ($r === false) {
                    $this->error('操作失败' . $AuthGroup->getError());
                } else {
                    $this->success('操作成功!');
                }
            } else {
                $this->error('操作失败' . $AuthGroup->getError());
            }
        }
    }
	//权限管理状态值
	public function authStatus($id = NULL, $type = NULL, $moble = 'AuthGroup')
    {
        if (empty($id)) {
            $this->error('参数错误！');
        }

        if (empty($type)) {
            $this->error('参数错误1！');
        }

        if (strpos(',', $id)) {
            $id = implode(',', $id);
        }

        $where['id'] = array('in', $id);

        switch (strtolower($type)) {
            case 'forbid':
                $data = array('status' => 0);
                break;

            case 'resume':
                $data = array('status' => 1);
                break;
            case 'del':
                if (M($moble)->where($where)->delete()) {
                    $this->success('操作成功！');
                } else {
                    $this->error('操作失败！');
                }

                break;

            default:
                $this->error('操作失败！');
        }

        if (M($moble)->where($where)->save($data)) {
            $this->success('操作成功！');
        } else {
            $this->error('操作失败！');
        }
    } 
	//重新初始化权限;
	public function authStart()
	{
		if(M('AuthGroup')->where(array('status' => 1))->delete()){
			$this->success('操作成功！');
		}else{
			$this->error('操作失败！');
		}
	}
	//执行访问授权;
	public function authAccess()
	{
		$auth_group = M('AuthGroup')->where(array(
		'status' => array('egt','0'),
		'module' => 'admin',
		'type' => \Common\Model\AuthGroupModel::TYPE_ADMIN
		))->getfield('id,title,rules');
		$node_list = $this->returnNodes();
		$map = array('module' => 'admin','type' => \Common\Model\AuthRuleModel::RULE_MAIN,'status' => 1);
		$main_rules = M('AuthRule')->where($map)->getField('name,id');
		$map = array('module' => 'admin','type' => \Common\Model\AuthRuleModel::RULE_URL,'status' => 1);
		$child_rules = M('AuthRule')->where($map)->getField('name,id');
		$this->assign('auth_group',$auth_group);
		$this->assign('node_list',$node_list);
		$this->assign('main_rules',$main_rules);
		$this->assign('auth_rules',$child_rules);
		$this->assign('this_group',$auth_group[(int)$_GET['group_id']]);
		$this->meta_title = '访问授权';
		$this->display();
	}
	//提交访问授权的操作；
    public function authAccessUp()
    {
        if(isset($_POST['rules'])){
            sort($_POST['rules']);
            $_POST['rules'] = implode(',', array_unique($_POST['rules']));
        }else{
            $_POST['rules'] = '';
        }
        $_POST['module'] = 'admin';
        $_POST['type'] = \Common\Model\AuthGroupModel::TYPE_ADMIN;
        $AuthGroup = D('AuthGroup');
        $data = $AuthGroup->create();
        if ($data) {
            if (empty($data['id'])) {
                $r = $AuthGroup->add();
            } else {
                $r = $AuthGroup->save();
            }

            if ($r === false) {
                $this->error('操作失败' . $AuthGroup->getError());
            } else {
                $this->success('操作成功!');
            }
        } else {
            $this->error('操作失败' . $AuthGroup->getError());
        }
    }
	//执行成员授权的操作;
    public function authUser($group_id)
    {
        if (empty($group_id)) {
            $this->error('参数错误');
        }

        $auth_group = M('AuthGroup')->where(array(
            'status' => array('egt', '0'),
            'module' => 'admin',
            'type' => \Common\Model\AuthGroupModel::TYPE_ADMIN
        ))->getfield('id,id,title,rules');
        $prefix = C('DB_PREFIX');
        $l_table = $prefix . \Common\Model\AuthGroupModel::MEMBER;
        $r_table = $prefix . \Common\Model\AuthGroupModel::AUTH_GROUP_ACCESS;
        $model = M()->table($l_table . ' m')->join($r_table . ' a ON m.id=a.uid');
        $_REQUEST = array();
        $list = $this->lists($model, array(
            'a.group_id' => $group_id,
            'm.status' => array('egt', 0)
        ), 'm.id asc', null, 'm.id,m.username,m.nickname,m.status');
        int_to_string($list);
        $this->assign('_list', $list);
        $this->assign('auth_group', $auth_group);
        $this->assign('this_group', $auth_group[(int)$_GET['group_id']]);
        $this->meta_title = '成员授权';
        $this->display();
    }
	//执行成员授权的新增;
	public function authUserAdd()
    {
        $uid = I('uid');
        if (empty($uid)) {
            $this->error('请输入后台成员信息');
        }
        if (!check($uid, 'd')) {
            $user = M('Admin')->where(array('username' => $uid))->find();
            if (!$user) {
                $user = M('Admin')->where(array('nickname' => $uid))->find();
            }
            if (!$user) {
                $user = M('Admin')->where(array('mobile' => $uid))->find();
            }
            if (!$user) {
                $this->error('用户不存在(id 用户名 昵称 手机号均可)');
            }
            $uid = $user['id'];
        }
        $gid = I('group_id');
        if ($res = M('AuthGroupAccess')->where(array('uid' => $uid))->find()) {
            if ($res['group_id'] == $gid) {
                $this->error('已经存在,请勿重复添加');
            } else {
                $res = M('AuthGroup')->where(array('id' => $gid))->find();
                if (!$res) {
                    $this->error('当前组不存在');
                }
                $this->error('已经存在[' . $res['title'] . ']组,不可重复添加');
            }
        }
        $AuthGroup = D('AuthGroup');
        if (is_numeric($uid)) {
            if (is_administrator($uid)) {
                $this->error('该用户为超级管理员');
            }

            if (!M('Admin')->where(array('id' => $uid))->find()) {
                $this->error('管理员用户不存在');
            }
        }
        if ($gid && !$AuthGroup->checkGroupId($gid)) {
            $this->error($AuthGroup->error);
        }
        if ($AuthGroup->addToGroup($uid, $gid)) {
            $this->success('操作成功');
        } else {
            $this->error($AuthGroup->getError());
        }
    }
	//解除成员授权
	public function authUserRemove()
	{
		$uid = I('uid');
		$gid = I('group_id');
		if($uid == UID){
			$this->error('不允许解除自身授权');
		}
		if(empty($uid) || empty($gid)){
			$this->error('参数有误！');
		}
		$AuthGroup = D('AuthGroup');
		if(!$AuthGroup->find($gid)){
			$this->error('用户组不存在');
		}
		if($AuthGroup->removeFromGroup($uid,$gid)){
			$this->success('操作成功');
		}else{
			$this->error('操作失败');
		}
	}
	//执行用户管理的操作
	public function user($name = NULL, $field = NULL,$status = NULL)
	{
		$where = array();
		if($field && $name){
			$where[$field] = $name;
		}
		if($status){
			$where['status'] = $status - 1;
		}
		$count = M('User')->where($where)->count();
		$Page = new \Think\Page($count,15);
		$show = $Page->show();
		$list = M('User')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	//执行用户管理编辑的操作
	public function userEdit($id = NULL)
	{
		if(empty($_POST)){
			if(empty($id)){
				$this->data = null;
			}else{
				$this->data = M('User')->where(array('id' => trim($id)))->find();
			}
			$this->display();
		}else{
			if($_POST['password']){
				$_POST['password'] = md5($_POST['password']);
			}else{
				unset($_POST['password']);
			}
			if(empty($id)){
				if(M('User')->add($_POST)){
					$this->success('新增成功！');
				}else{
					$this->error('新增失败！');
				}
			}else{
				if(M('User')->save($_POST)){
					$this->success('编辑成功！');
				}else{
					$this->error('编辑失败！');
				}
			}
		}
	}
	//执行用户状态的编辑
	public function userStatus($id = NULL,$type = NULL,$moble = 'User')
	{
		if(empty($id)){
			$this->error('参数错误！');
		}
		if(empty($type)){
			$this->error('参数错误！');
		}
		if(strpos(',',$id)){
			$id = implode(',',$id);
		}
		$where['id'] = array('in',$id);
		switch(strtolower($type)){
			case 'forbid':
				$data = array('status' => 0);
				break;
			case 'resume':
				$data = array('status' => 1);
				break;
			case 'del':
				if(M($moble)->where($where)->delete()){
					$this->success('操作成功！');
				}else{
					$this->error('操作失败！');
				}
				break;
			default:
				$this->error('操作失败！');
				
		}
		if(M($moble)->where($where)->save($data)){
			$this->success('操作成功！');
		}else{
			$this->error('操作失败！');
		}
	}
	//执行管理员用户日志的操作
    public  function   AdminLog($name = NULL, $status = NULL ,$field = NULL)
    {
        $where = array();
        if($field && $name){
            if($field = 'username'){
                $where['uid'] = M('Admin')->where(array('username' => $name))->getField('id');
            }else{
                $where[$field] = $name;
            }
        }
        if($status){
            $where['status'] = $status - 1;
        }
        $count  = M('AdminLog')->where($where)->count();
        $page =    new \Think\Page($count,30);
        $show  = $page->show();
        $list = M('AdminLog')->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        foreach($list as $k=>$v){
            $list[$k]['uid'] = M('Admin')->where(array('id' => $v['uid']))->getField('username');
            $list[$k]['title'] = M('Admin')->where(array('id' => $v['uid']))->getField('nickname');
        }
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    //执行管理员日志删除的操作
    public  function  AdminLogStatus($id = NULL,$type = NULL,$moble = 'AdminLog')
    {
        if(empty($id)){
            $this->error('参数错误！');
        }
        if(empty($type)){
            $this->error('参数错误！');
        }
        if(strpos(',',$id)){
            $id = implode(',',$id);
        }
        $where['id'] = array('in',$id);
        switch(strtolower($type)){
            case 'del':
                if(M($moble)->where($where)->delete()){
                    $this->success('操作成功！');
                }else{
                    $this->error('操作失败！');
                }
                break;
            default:
                $this->error('操作失败！');
        }
    }
}