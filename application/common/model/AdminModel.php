<?php
/*由脚本生成 powerBy--Reer*/

namespace app\common\model;

class AdminModel extends BaseModel
{
	protected $table = 'admin';
	protected static $_self = null;
	static function getInstance(){
		if(empty(self::$_self)){
			self::$_self = new AdminModel();
		}
		return self::$_self;
	}
}