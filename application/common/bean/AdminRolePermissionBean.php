<?php
/*由bean脚本生成 powerBy--Reer*/

namespace app\common\bean;

class AdminRolePermissionBean extends BaseBean
{
	static $id = 'id'; //
	static $adminRoleId = 'admin_role_id'; //后台角色id、
	static $adminPermissionId = 'admin_permission_id'; //后台权限id
	static $tableName = 'admin_role_permission';
	static $alias = 'AdminRolePermissionBean';

	public function getId(){
		return $this->getParameter(self::$id);
	}

	public function setId($id){
		$this->setParameter('id',$id);
	}

	public function getAdminRoleId(){
		return $this->getParameter(self::$adminRoleId);
	}

	public function setAdminRoleId($adminRoleId){
		$this->setParameter('admin_role_id',$adminRoleId);
	}

	public function getAdminPermissionId(){
		return $this->getParameter(self::$adminPermissionId);
	}

	public function setAdminPermissionId($adminPermissionId){
		$this->setParameter('admin_permission_id',$adminPermissionId);
	}

}