<?php
namespace Admin\Controller;

class MenuController extends AdminController {
    public function index()
	{
		$this->display();
    }
    //执行权限列表首页的显示的效果
    public  function  menu()
    {

        //执行查询全部节点数
        $count = M('Menu')->count();
        //顶级节点数
        $dj = M('Menu')->where(array('pid' => 0))->count();
        //其他节点数
        $qt = $count - $dj;
        $data=D('Menu')->getTreeData('tree','sort,id');
        $this->assign('list',$data);
        $this->assign('count',$count);
        $this->assign('dj',$dj);
        $this->assign('qt',$qt);
        $this->display();
    }
    //执行菜单的编辑的效果；
    public function menuEdit($id = NULL)
    {
        if(empty($_POST)){
            if(empty($id)){
                $this->data = null;
            }else{
                $this->data = M('Menu')->where(array('id' => trim($id)))->find();
            }
            $this->display();
        }else{
            if ($_POST['addtime']) {
                if (addtime(strtotime($_POST['addtime'])) == '---') {
                    $this->error('添加时间格式错误');
                }
                else {
                    $_POST['addtime'] = strtotime($_POST['addtime']);
                }
            }
            else {
                $_POST['addtime'] = time();
            }
            if(empty($id)){
                $_POST['is_dev']  = '0';
                $_POST['addtime'] = time();
                if(M('Menu')->add($_POST)){
                    $this->success('新增成功！');
                }else{
                    $this->error('新增失败！');
                }
            }else{
                if(M('Menu')->save($_POST)){
                    $this->success('编辑成功！');
                }else{
                    $this->error('编辑失败！');
                }
            }
        }
    }
    //执行添加子集菜单的效果
    public function msubsetEdit($sid = NULL)
    {
        if(empty($_POST)){
            if(empty($sid)){
                $this->data = null;
            }else{
                $this->data = M('Menu')->where(array('id' => trim($sid)))->find();
            }
            $this->display();
        }else{
            if ($_POST['addtime']) {
                if (addtime(strtotime($_POST['addtime'])) == '---') {
                    $this->error('添加时间格式错误');
                }
                else {
                    $_POST['addtime'] = strtotime($_POST['addtime']);
                }
            }
            else {
                $_POST['addtime'] = time();
            }
            if(empty($sid)){
                $_POST['is_dev']  = '0';
                $_POST['addtime'] = time();
                if(M('Menu')->add($_POST)){
                    $this->success('新增成功！');
                }else{
                    $this->error('新增失败！');
                }
            }else{
                if(M('Menu')->save($_POST)){
                    $this->success('编辑成功！');
                }else{
                    $this->error('编辑失败！');
                }
            }
        }
    }
    //执行父集菜单和子集菜单删除的效果
    public  function   menuDete()
    {
        $id=I('id');
        $map=array(
            'id'=>$id
        );
        $list=D('Menu')->deleteData($map);
        if($list){
            $this->success('删除成功');
        }else{
            $this->error('请先删除子菜单');
        }
    }
    //执行权限列表显示的效果
    public  function  auth()
    {
        //执行查询全部节点数
        $count = M('AuthRule')->count();
        //顶级节点数
        $dj = M('AuthRule')->where(array('pid' => 0))->count();
        //其他节点数
        $qt = $count - $dj;
        $data=D('AuthRule')->getTreeData('tree','id','title');
        $assign=array(
            'data'=>$data
        );
        $this->assign('list',$data);
        $this->assign('count',$count);
        $this->assign('dj',$dj);
        $this->assign('qt',$qt);
        $this->display();
    }
    //执行权限编辑的效果
    public  function AuthEdit($id = NULL)
    {
        if(empty($_POST)){
            if(empty($id)){
                $this->data = null;
            }else{
                $this->data = M('AuthRule')->where(array('id' => trim($id)))->find();
            }
            $this->display();
        }else{
            if ($_POST['addtime']) {
                if (addtime(strtotime($_POST['addtime'])) == '---') {
                    $this->error('添加时间格式错误');
                }
                else {
                    $_POST['addtime'] = strtotime($_POST['addtime']);
                }
            }
            else {
                $_POST['addtime'] = time();
            }
            if(empty($id)){

                $_POST['module']  = 'admin';
                $_POST['type']  = '2';
                $_POST['addtime'] = time();
                if(M('AuthRule')->add($_POST)){
                    $this->success('新增成功！');
                }else{
                    $this->error('新增失败！');
                }
            }else{
                if(M('AuthRule')->save($_POST)){
                    $this->success('编辑成功！');
                }else{
                    $this->error('编辑失败！');
                }
            }
        }
    }
    //执行添加子集权限的操作
    public  function  AuthsEdit($sid = NULL)
    {
        if(empty($_POST)){
            if(empty($sid)){
                $this->data = null;
            }else{
                $this->data = M('AuthRule')->where(array('id' => trim($sid)))->find();
            }
            $this->display();
        }else{
            if ($_POST['addtime']) {
                if (addtime(strtotime($_POST['addtime'])) == '---') {
                    $this->error('添加时间格式错误');
                }
                else {
                    $_POST['addtime'] = strtotime($_POST['addtime']);
                }
            }
            else {
                $_POST['addtime'] = time();
            }
            if(empty($sid)){
                $_POST['module']  = 'admin';
                $_POST['addtime'] = time();
                if(M('AuthRule')->add($_POST)){
                    $this->success('新增成功！');
                }else{
                    $this->error('新增失败！');
                }
            }else{
                if(M('AuthRule')->save($_POST)){
                    $this->success('编辑成功！');
                }else{
                    $this->error('编辑失败！');
                }
            }
        }
    }
    //执行父集子集权限删除的效果;
    public function AuthDelete()
    {
        $id=I('id');
        $map=array(
            'id'=>$id
        );
        $list=D('AuthRule')->deleteData($map);
        if($list){
            $this->success('删除成功');
        }else{
            $this->error('请先删除子权限');
        }
    }


}