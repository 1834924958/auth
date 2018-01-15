<?php
namespace Admin\Controller;

class ArticleController extends AdminController {
    public function index()
	{
		$this->display();
    }
	//执行广告管理显示;
	public function adver($name = NULL, $field = NULL,$status = NULL)
	{
		$where = array();
		if($field && $name){
			if($field == 'name'){
				$where['id'] = M('Adver')->where(array('name' => $name))->getField('id');
			}else{
				$where[$field] = $name;
			}	
		}
		if($status){
			$where['status'] = $status -1;
		}
		$count = M('Adver')->where($where)->count();
		$Page = new \Think\Page($count,5);
		$show = $Page->show();
		$list = M('Adver')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	//执行广告管理的编辑;
	public function adverEdit($id = NULL)
	{
		if (empty($_POST)) {
			if ($id) {
				$this->data = M('Adver')->where(array('id' => trim($id)))->find();
			}
			else {
				$this->data = null;
			}

			$this->display();
		}
		else {
			$upload = new \Think\Upload();
			$upload->maxSize = 3145728;
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');
			$upload->rootPath = './Public/Upload/adver/';
			$upload->autoSub = false;
			$info = $upload->upload();

			if ($info) {
				foreach ($info as $k => $v) {
					$_POST[$v['key']] = $v['savename'];
				}
			}
			
			
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
			if ($_POST['endtime']) {
				if (addtime(strtotime($_POST['endtime'])) == '---') {
					$this->error('编辑时间格式错误');
				}
				else {
					$_POST['endtime'] = strtotime($_POST['endtime']);
				}
			}
			else {
				$_POST['endtime'] = time();
			}
			if ($_POST['id']) {
				$rs = M('Adver')->save($_POST);
			}
			else {
				$_POST['addtime'] = time();
				$rs = M('Adver')->add($_POST);
			}

			if ($rs) {
				$this->success('编辑成功！');
			}
			else {
				$this->error('编辑失败！');
			}
		}
	}
	//执行广告管理图片的上传
	public function adverImage()
	{
		$upload = new \Think\Upload();
		$upload->maxSize = 3145728;
		$upload->exts = array('jpg','gif','png','jpeg');
		$upload->rootPath = './Upload/adver/';
		$upload->autoSub = false;
		$info = $upload->upload();
		foreach($info as $k => $v){
			$path = $v['savepath'].$v['savename'];
			echo $path;
			exit();
		}
	}
	//执行广告管理的状态值的操作;
	public function adverStatus($id = NULL,$type = NULL,$moble='Adver')
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
	//执行友情链接的页面
	public function links($name = NULL, $field = NULL,$status = NULL)
	{
		$where = array();
		if($field && $name){
			if($field == 'name'){
				$where['id'] = M('Link')->where(array('name' => $name))->getField('id');
			}else{
				$where[$field] = $name;
			}
		}
		if($status){
			$where['status'] = $status - 1;
		}
		$count = M('Link')->where($where)->count();
		$Page = new \Think\Page($count,8);
		$show = $Page->show();
		$list = M('Link')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	//执行友情链接的编辑
	public function linksEdit($id = NULL)
	{
		if(empty($_POST)){
			if($id){
				$this->data = M('Link')->where(array('id' => trim($id)))->find();
			}else{
				$this->data = null;
			}
			$this->display();
		}else{
			if($_POST['addtime']){
				if(addtime(strtotime($_POST['addtime'])) == '---'){
					$this->error('添加时间格式错误');
				}else{
					$_POST['addtime'] = strtotime($_POST['addtime']);
				}
			}else{
				$_POST['addtime'] = time();
			}
			if($_POST['endtime']){
				if(addtime(strtotime($_POST['endtime'])) == '---'){
					$this->error('编辑时间格式错误！');
				}else{
					$_POST['endtime'] = strtotime($_POST['endtime']);
				}
			}else{
				$_POST['endtime'] = time();
			}
			if($_POST['id']){
				$rs = M('Link')->save($_POST);
			}else{
				$_POST['addtime'] = time();
				$rs = M('Link')->add($_POST);
			}
			if($rs){
				$this->success('编辑成功！');
			}else{
				$this->error('编辑失败！');
			}
		}
	}
	//执行友情链接状态的操作;
	public function linkStatus($id = NULL, $type = NULL,$moble = 'Link')
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
		}
		if(M($moble)->where($where)->save($data)){
			$this->success('操作成功！');
		}else{
			$this->error('操作失败！');
		}
	}
	//执行文章管理的页面显示
	public function articles($name = NULL, $field = NULL, $status = NULL, $type = NULL)
	{
		$where = array();
		if ($field && $name) {
			if ($field == 'name') {
				$where['id'] = M('Article')->where(array('username' => $name))->getField('id');
			}else if ($field == 'title') {
				$where['title'] = array('like', '%' . $name . '%');
			}
			else {
				$where[$field] = $name;
			}
		}

		if ($status) {
			$where['status'] = $status - 1;
		}
		if($type){
			$where['type'] = $type;
		}
		$count = M('Article')->where($where)->count();
		$Page = new \Think\Page($count,15);
		$show  = $Page->show();
		$list = M('Article')->where($where)->order('sort asc,endtime desc,id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		foreach($list as $k => $v){
			$list[$k]['adminid'] = M('Admin')->where(array('id' => $v['adminid']))->getField('username');
			$list[$k]['type'] = M('ArticleType')->where(array('name' => $v['type']))->getField('title');
		}
		$article_type = M('ArticleType')->select();
		foreach($article_type as $k => $v){
			$at[$v['name']] = $v['title'];
		}
		$this->assign('article_type',$at);
		$this->assign('list',$list);
		$this->assign('page',$Page);
		$this->display();
	}
	//执行文章管理的编辑的操作
	public  function articlesEdit($id = NULL, $type = NULL)
	{
		if(empty($_POST)){
			$list = M('ArticleType')->select();
			foreach($list as $k => $v){
				$listType[$v['name']] = $v['title'];
			}
			$this->assign('list',$listType);
			if($id){
				$this->data = M('Article')->where(array('id' => trim($id)))->find();
			}else{
				$this->data = null;
			}
			$this->display();
		}else{
			if($_POST['addtime']){
				if(addtime(strtotime($_POST['addtime'])) == '---'){
					$this->error('添加时间格式错误！');
				}else{
					$_POST['addtime'] = strtotime($_POST['addtime']);
				}
			}else{
				$_POST['addtime'] = time();
			}
			
			if($_POST['endtime']){
				if(addtime(strtotime($_POST['endtime'])) == '---'){
					$this->error('编辑时间格式错误！');
				}else{
					$_POST['endtime'] = strtotime($_POST['endtime']);
				}
			}else{
				$_POST['endtime'] = time();
			}
			if($_POST['id']){
				$rs = M('Article')->save($_POST);
			}else{
				$_POST['addtime'] = time();
				$_POST['adminid'] = session('admin_id');
				$rs = M('Article')->add($_POST);
			}
			if($rs){
				$this->success('编辑成功！');
			}else{
				$this->error('编辑失败！');
			}
		}
	}
	//执行文章管理的状态的操作
	public function articlesStatus($id = NULL, $type = NULL,$moble = 'Article')
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
		switch (strtolower($type)){
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
	//执行文章类型的页面显示
	public function articleType($name = NULL, $field = NULL,$status = NULL)
	{
		$where = array();
		if($field && $name){
			if($field == 'name'){
				$where['id'] = M('ArticleType')->where(array('name' => $name))->getField('id');
			}else{
				$where[$field] = $name;
			}
		}
		if($status){
			$where['status'] = $status - 1;
		}
		$count = M('ArticleType')->where($where)->count();
		$Page = new \Think\Page($count,8);
		$show = $Page->show();
		$list = M('ArticleType')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	//执行文章类型的编辑
	public  function articleTypeEdit($id = NULL)
	{
		$list = M('ArticleType')->select();
		foreach($list as $k => $v){
			$listType[$v['name']] = $v['title'];
		}
		$this->assign('list',$listType);
		if(empty($_POST)){
			if($id){
				$this->data = M('ArticleType')->where(array('id' => trim($id)))->find();
			}else{
				$this->data = null;
			}
			$this->display();
		}else{
			if($_POST['addtime']){
				if(addtime(strtotime($_POST['addtime'])) == '---'){
					$this->error('添加时间格式错误');
				}else{
					$_POST['addtime'] = strtotime($_POST['addtime']);
				}
			}else{
				$_POST['addtime'] = time();
			}
			if($_POST['endtime']){
				if(addtime(strtotime($_POST['endtime'])) == '---'){
					$this->error('编辑时间格式错误！');
				}else{
					$_POST['endtime'] = strtotime($_POST['endtime']);
				}
			}else{
				$_POST['endtime'] = time();
			}
			if($_POST['id']){
				$rs = M('ArticleType')->save($_POST);
			}else{
				$_POST['addtime'] = time();
				$rs = M('ArticleType')->add($_POST);
			}
			if($rs){
				$this->success('编辑成功！');
			}else{
				$this->error('编辑失败！');
			}
		}
	}
	//执行文章管理的状态值的显示
	public function articleTypeStatus($id = NULL, $type = NULL,$moble = 'ArticleType')
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
		}
		if(M($moble)->where($where)->save($data)){
			$this->success('操作成功！');
		}else{
			$this->error('操作失败！');
		}
	}
	
	
}