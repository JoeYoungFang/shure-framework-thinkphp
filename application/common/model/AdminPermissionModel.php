<?php
/*由脚本生成 powerBy--Reer*/

namespace app\common\model;

use app\common\bean\AdminPermissionBean;
use app\common\bean\AdminRolePermissionBean;
use think\Exception;

class AdminPermissionModel extends BaseModel
{
	protected $table = 'admin_permission';
	protected static $_self = null;
	static function getInstance(){
		if(empty(self::$_self)){
			self::$_self = new AdminPermissionModel();
		}
		return self::$_self;
	}

    /** 根据权限获取对应角色的权限信息
     * @param $roleId
     * @param AdminPermissionBean $adminPermissionBean
     * @return array|bool|null|string|\think\Model
     */
	public function getRolePermissionDetail($roleId,AdminPermissionBean $adminPermissionBean){
	    $adminPermissionBean->setParameter(AdminRolePermissionBean::$adminPermissionId,$roleId);
        try {
            $result = $this->alias(AdminPermissionBean::$alias)->fullJoin(AdminRolePermissionBean::$tableName . " " . AdminRolePermissionBean::$alias, AdminPermissionBean::$alias . POINST . AdminPermissionBean::$id . " = " . AdminRolePermissionBean::$alias . POINST . AdminRolePermissionBean::$adminPermissionId)
                ->where($adminPermissionBean->getData())->find();
        } catch (Exception $e) {
            $result = false;
        }
        return $result;
    }
}