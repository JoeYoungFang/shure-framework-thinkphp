<?php
/*由bean脚本生成 powerBy--Reer*/

namespace app\common\bean;

class AdminPermissionBean extends BaseBean
{
	static $id = 'id'; //
	static $name = 'name'; //权限名称
	static $parentId = 'parent_id'; //父级id 0为模块
	static $model = 'model'; //模块名
	static $controller = 'controller'; //控制器名
	static $action = 'action'; //f方法名
	static $icon = 'icon'; //图标
	static $isPlay = 'is_play'; //是否菜单显示 0否，1显示
	static $sort = 'sort'; //排序
	static $createdAt = 'created_at'; //创建时间
	static $tableName = 'admin_permission';
	static $alias = 'AdminPermissionBean';

	public function getId(){
		return $this->getParameter(self::$id);
	}

	public function setId($id){
		$this->setParameter('id',$id);
	}

	public function getName(){
		return $this->getParameter(self::$name);
	}

	public function setName($name){
		$this->setParameter('name',$name);
	}

	public function getParentId(){
		return $this->getParameter(self::$parentId);
	}

	public function setParentId($parentId){
		$this->setParameter('parent_id',$parentId);
	}

	public function getModel(){
		return $this->getParameter(self::$model);
	}

	public function setModel($model){
		$this->setParameter('model',$model);
	}

	public function getController(){
		return $this->getParameter(self::$controller);
	}

	public function setController($controller){
		$this->setParameter('controller',$controller);
	}

	public function getAction(){
		return $this->getParameter(self::$action);
	}

	public function setAction($action){
		$this->setParameter('action',$action);
	}

	public function getIcon(){
		return $this->getParameter(self::$icon);
	}

	public function setIcon($icon){
		$this->setParameter('icon',$icon);
	}

	public function getIsPlay(){
		return $this->getParameter(self::$isPlay);
	}

	public function setIsPlay($isPlay){
		$this->setParameter('is_play',$isPlay);
	}

	public function getSort(){
		return $this->getParameter(self::$sort);
	}

	public function setSort($sort){
		$this->setParameter('sort',$sort);
	}

	public function getCreatedAt(){
		return $this->getParameter(self::$createdAt);
	}

	public function setCreatedAt($createdAt){
		$this->setParameter('created_at',$createdAt);
	}

}