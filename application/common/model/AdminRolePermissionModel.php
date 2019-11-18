<?php
/*由脚本生成 powerBy--Reer*/

namespace app\common\model;

class AdminRolePermissionModel extends BaseModel
{
	protected $table = 'admin_role_permission';
	protected static $_self = null;
	static function getInstance(){
		if(empty(self::$_self)){
			self::$_self = new AdminRolePermissionModel();
		}
		return self::$_self;
	}
}