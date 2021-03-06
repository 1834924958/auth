<?php
namespace Admin\Controller;
class AdminController extends \Think\Controller 
{
	public function __construct()
	{
		parent::__construct();
		$config = M('Config')->where(array('id' => 1))->find();
		C($config);
		if(!session('admin_id')){
			$this->redirect('Admin/Login/index');
		}
		define('UID', session('admin_id'));
		if (session('admin_id') == 1) {
			define('IS_ROOT', 1);
		}
		else {
			define('IS_ROOT', 0);
		}
		$access = $this->accessControl();
		if ($access === false){
			$this->error('403:禁止访问');
		}else if ($access === null){
			$dynamic = $this->checkDynamic();
			if ($dynamic === null){
				$rule = strtolower(MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME);

				if (!$this->checkRule($rule, array('in', '1,2'))){
					$this->error('未授权访问!');
				}
			}else if ($dynamic === false){
				$this->error('未授权访问!');
			}
		}
		$this->assign('__MENU__', $this->getMenus());
	}
    public function index()
	{
		$this->redirect('Admin/Index/index');
    }
	protected function checkDynamic()
	{
		if (IS_ROOT) {
			return true;
		}

		return null;
	}
	final protected function checkRule($rule, $type = Common\Model\AuthRuleModel::RULE_URL, $mode = 'url')
	{
		if (IS_ROOT) {
			return true;
		}

		static $Auth;

		if (!$Auth) {
			$Auth = new \Think\Auth();
		}

		if (!$Auth->check($rule, UID, $type, $mode)) {
			return false;
		}

		return true;
	}
	/*
	*。如果父类中的方法被声明为 final，则子类无法覆盖该方法。如果一个类被声明为 final，则不能被继承。 
	*/
	final protected function accessControl()
	{
		if (IS_ROOT) {
			return true;
		}

		$allow = C('ALLOW_VISIT');
		$deny = C('DENY_VISIT');
		$check = strtolower(CONTROLLER_NAME . '/' . ACTION_NAME);
		if (!empty($deny) && in_array_case($check, $deny)) {
			return false;
		}

		if (!empty($allow) && in_array_case($check, $allow)) {
			return true;
		}

		return null;
	}
	final public function getMenus($controller = CONTROLLER_NAME)
	{
		if (empty($menus)) {
			$where['pid'] = 0;
			$where['hide'] = 0;

			if (!C('DEVELOP_MODE')) {
				$where['is_dev'] = 0;
			}

			$menus['main'] = M('Menu')->where($where)->order('sort asc')->select();
			$menus['child'] = array();
			$current = M('Menu')->where('url like \'' . $controller . '/' . ACTION_NAME . '%\'')->field('id')->find();

			if (!$current) {
				$current = M('Menu')->where('url like \'' . $controller . '/%\'')->field('id')->find();
			}

			if ($current) {
				$nav = D('Menu')->getPath($current['id']);
				$nav_first_title = $nav[0]['title'];

				foreach ($menus['main'] as $key => $item) {
					if (!is_array($item) || empty($item['title']) || empty($item['url'])) {
						$this->error('控制器基类$menus属性元素配置有误');
					}

					if (stripos($item['url'], MODULE_NAME) !== 0) {
						$item['url'] = MODULE_NAME . '/' . $item['url'];
					}

					if (!IS_ROOT && !$this->checkRule($item['url'], \Common\Model\AuthRuleModel::RULE_MAIN, null)) {
						unset($menus['main'][$key]);
						continue;
					}

					if ($item['title'] == $nav_first_title) {
						$menus['main'][$key]['class'] = 'current';
						$groups = M('Menu')->where('pid = ' . $item['id'])->distinct(true)->field('`group`')->select();

						if ($groups) {
							$groups = array_column($groups, 'group');
						}
						else {
							$groups = array();
						}

						$where = array();
						$where['pid'] = $item['id'];
						$where['hide'] = 0;

						if (!C('DEVELOP_MODE')) {
							$where['is_dev'] = 0;
						}

						$second_urls = M('Menu')->where($where)->getField('id,url');

						if (!IS_ROOT) {
							$to_check_urls = array();

							foreach ($second_urls as $key => $to_check_url) {
								if (stripos($to_check_url, MODULE_NAME) !== 0) {
									$rule = MODULE_NAME . '/' . $to_check_url;
								}
								else {
									$rule = $to_check_url;
								}

								if ($this->checkRule($rule, \Common\Model\AuthRuleModel::RULE_URL, null)) {
									$to_check_urls[] = $to_check_url;
								}
							}
						}

						foreach ($groups as $g) {
							$map = array('group' => $g);

							if (isset($to_check_urls)) {
								if (empty($to_check_urls)) {
									continue;
								}
								else {
									$map['url'] = array('in', $to_check_urls);
								}
							}

							$map['pid'] = $item['id'];
							$map['hide'] = 0;

							if (!C('DEVELOP_MODE')) {
								$map['is_dev'] = 0;
							}

							$menuList = M('Menu')->where($map)->field('id,pid,title,url,tip,ico_name')->order('sort asc')->select();
							$menus['child'][$g] = list_to_tree($menuList, 'id', 'pid', 'operater', $item['id']);
						}

						if ($menus['child'] === array()) {
						}
					}
				}
			}
		}

		return $menus;
	}
	//放回节点
	final protected function returnNodes($tree = true)
	{
		static $tree_nodes = array();
		if ($tree && !empty($tree_nodes[(int) $tree])) {
			return $tree_nodes[$tree];
		}

		if ((int) $tree) {
			$list = M('Menu')->field('id,pid,title,url,tip,hide')->order('sort asc')->select();

			foreach ($list as $key => $value) {
				if (stripos($value['url'], MODULE_NAME) !== 0) {
					$list[$key]['url'] = MODULE_NAME . '/' . $value['url'];
				}
			}

			$nodes = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'operator', $root = 0);

			foreach ($nodes as $key => $value) {
				if (!empty($value['operator'])) {
					$nodes[$key]['child'] = $value['operator'];
					unset($nodes[$key]['operator']);
				}
			}
		}
		else {
			$nodes = M('Menu')->field('title,url,tip,pid')->order('sort asc')->select();

			foreach ($nodes as $key => $value) {
				if (stripos($value['url'], MODULE_NAME) !== 0) {
					$nodes[$key]['url'] = MODULE_NAME . '/' . $value['url'];
				}
			}
		}

		$tree_nodes[(int) $tree] = $nodes;
		return $nodes;
	}
	protected function lists($model, $where = array(), $order = '', $base = array(
			'status' => array('egt', 0)
			), $field = true)
	{
		$options = array();
		$REQUEST = (array) I('request.');

		if (is_string($model)) {
			$model = M($model);
		}

		$OPT = new \ReflectionProperty($model, 'options');
		$OPT->setAccessible(true);
		$pk = $model->getPk();

		if ($order === null) {
		}
		else {
			if (isset($REQUEST['_order']) && isset($REQUEST['_field']) && in_array(strtolower($REQUEST['_order']), array('desc', 'asc'))) {
				$options['order'] = '`' . $REQUEST['_field'] . '` ' . $REQUEST['_order'];
			}
			else {
				if (($order === '') && empty($options['order']) && !empty($pk)) {
					$options['order'] = $pk . ' desc';
				}
				else if ($order) {
					$options['order'] = $order;
				}
			}
		}

		unset($REQUEST['_order']);
		unset($REQUEST['_field']);
		$options['where'] = array_filter(array_merge((array) $base, (array) $where), function($val) {
			if (($val === '') || ($val === null)) {
				return false;
			}
			else {
				return true;
			}
		});

		if (empty($options['where'])) {
			unset($options['where']);
		}

		$options = array_merge((array) $OPT->getValue($model), $options);
		$total = $model->where($options['where'])->count();

		if (isset($REQUEST['r'])) {
			$listRows = (int) $REQUEST['r'];
		}
		else {
			$listRows = (0 < C('LIST_ROWS') ? C('LIST_ROWS') : 10);
		}

		$page = new \Think\Page($total, $listRows, $REQUEST);

		if ($listRows < $total) {
			$page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		}

		$p = $page->show();
		$this->assign('_page', $p ? $p : '');
		$this->assign('_total', $total);
		$options['limit'] = $page->firstRow . ',' . $page->listRows;
		$model->setProperty('options', $options);
		return $model->field($field)->select();
	}
}