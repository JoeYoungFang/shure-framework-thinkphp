<?php
/*由bean脚本生成 powerBy--Reer*/

namespace app\common\bean;

class AdminRoleBean extends BaseBean
{
	static $id = 'id'; //
	static $name = 'name'; //角色名称
	static $updatedAt = 'updated_at'; //
	static $createdAt = 'created_at'; //
	static $tableName = 'admin_role';
	static $alias = 'AdminRoleBean';

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

	public function getUpdatedAt(){
		return $this->getParameter(self::$updatedAt);
	}

	public function setUpdatedAt($updatedAt){
		$this->setParameter('updated_at',$updatedAt);
	}

	public function getCreatedAt(){
		return $this->getParameter(self::$createdAt);
	}

	public function setCreatedAt($createdAt){
		$this->setParameter('created_at',$createdAt);
	}

}