<?php
/*由bean脚本生成 powerBy--Reer*/

namespace app\common\bean;

class AdminBean extends BaseBean
{
	static $id = 'id'; //
	static $adminRoleId = 'admin_role_id'; //后台角色id
	static $username = 'username'; //账号
	static $realname = 'realname'; //真实姓名
	static $email = 'email'; //邮箱
	static $password = 'password'; //密码
	static $ip = 'ip'; //ip地址
	static $loginAt = 'login_at'; //登录时间
	static $status = 'status'; //1启用，2禁用
	static $createdAt = 'created_at'; //创建时间
	static $updatedAt = 'updated_at'; //更新时间
	static $tableName = 'admin';
	static $alias = 'AdminBean';

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

	public function getUsername(){
		return $this->getParameter(self::$username);
	}

	public function setUsername($username){
		$this->setParameter('username',$username);
	}

	public function getRealname(){
		return $this->getParameter(self::$realname);
	}

	public function setRealname($realname){
		$this->setParameter('realname',$realname);
	}

	public function getEmail(){
		return $this->getParameter(self::$email);
	}

	public function setEmail($email){
		$this->setParameter('email',$email);
	}

	public function getPassword(){
		return $this->getParameter(self::$password);
	}

	public function setPassword($password){
		$this->setParameter('password',$password);
	}

	public function getIp(){
		return $this->getParameter(self::$ip);
	}

	public function setIp($ip){
		$this->setParameter('ip',$ip);
	}

	public function getLoginAt(){
		return $this->getParameter(self::$loginAt);
	}

	public function setLoginAt($loginAt){
		$this->setParameter('login_at',$loginAt);
	}

	public function getStatus(){
		return $this->getParameter(self::$status);
	}

	public function setStatus($status){
		$this->setParameter('status',$status);
	}

	public function getCreatedAt(){
		return $this->getParameter(self::$createdAt);
	}

	public function setCreatedAt($createdAt){
		$this->setParameter('created_at',$createdAt);
	}

	public function getUpdatedAt(){
		return $this->getParameter(self::$updatedAt);
	}

	public function setUpdatedAt($updatedAt){
		$this->setParameter('updated_at',$updatedAt);
	}

}