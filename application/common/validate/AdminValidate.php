<?php
/*由bean脚本生成 powerBy--Joee*/

namespace app\common\validate;

use app\common\bean\AdminBean;

class AdminValidate extends BaseValidate
{
    static $all = 'all';
    static $login = 'login';
    static $add = 'add';
    static $edit = 'edit';
    static $pkId = 'id';


	public function __construct(array $rules = [], array $message = [], array $field = [])
	{
		parent::__construct($rules, $message, $field);

		$this->rule = [
			 AdminBean::$id => 'require', //
			 AdminBean::$adminRoleId => 'require', //后台角色id
			 AdminBean::$username => 'require|unique'.AdminBean::$tableName, //账号
			 AdminBean::$realname => 'require', //真实姓名
			 AdminBean::$email => 'require', //邮箱
			 AdminBean::$password => 'require', //密码
			 AdminBean::$ip => 'require', //ip地址
			 AdminBean::$loginAt => 'require', //登录时间
			 AdminBean::$createdAt => 'require', //创建时间
			 AdminBean::$updatedAt => 'require', //更新时间
		];
		$this->message = [
			 AdminBean::$id => 'id必须', //
			 AdminBean::$adminRoleId => 'admin_role_id必须', //后台角色id
			 AdminBean::$username => 'username必须/唯一', //账号
			 AdminBean::$realname => 'realname必须', //真实姓名
			 AdminBean::$email => 'email必须', //邮箱
			 AdminBean::$password => 'password必须', //密码
			 AdminBean::$ip => 'ip必须', //ip地址
			 AdminBean::$loginAt => 'login_at必须', //登录时间
			 AdminBean::$createdAt => 'created_at必须', //创建时间
			 AdminBean::$updatedAt => 'updated_at必须', //更新时间
		];
		$this->scene = [
            self::$all => [AdminBean::$id,AdminBean::$adminRoleId,AdminBean::$username,AdminBean::$realname,AdminBean::$email,AdminBean::$password,AdminBean::$ip,AdminBean::$loginAt,AdminBean::$createdAt,AdminBean::$updatedAt,],
            self::$login => [AdminBean::$username,AdminBean::$password],
            self::$add => [AdminBean::$username,AdminBean::$password,AdminBean::$email],
            self::$edit => [AdminBean::$id,AdminBean::$username,AdminBean::$email],
            self::$pkId => [AdminBean::$id]
		];
	}


}