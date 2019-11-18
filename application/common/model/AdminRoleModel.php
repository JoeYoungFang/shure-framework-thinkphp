<?php
/*由脚本生成 powerBy--Reer*/

namespace app\common\model;

class AdminRoleModel extends BaseModel
{
	protected $table = 'admin_role';
	protected static $_self = null;
	static function getInstance(){
		if(empty(self::$_self)){
			self::$_self = new AdminRoleModel();
		}
		return self::$_self;
	}
}